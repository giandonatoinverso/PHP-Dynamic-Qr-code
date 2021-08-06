<?php

/**
 * PHP Dynamic Qr code
 *
 * @author    Giandonato Inverso <info@giandonatoinverso.it>
 * @copyright Copyright (c) 2020-2021
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/giandonatoinverso/PHP-Dynamic-Qr-code
 * @version   1.0
 */

require_once 'config/config.php';

class Profile
{
    /**
     *
     */
    public function __construct()
    {
        // Only super admin is allowed to access this page
        // if ($_SESSION['admin_type'] !== 'super')
        //     $this->failure('Only a "super admin" account can access the admin listing page', 'Location: index.php');
    }

    /**
     *
     */
    public function __destruct()
    {
    }

    public function get_user($check_session_id = 'false', $username = null)
    {
        $db = getDbInstance();

        if ($check_session_id) {
            $user_id = $_SESSION['user_id'];
            $db->where('id', $user_id);
        }
        $select = ['id', 'first_name','last_name','mobile_no','facebook','twitter','instagram','profile_pic'];
        return $db->objectBuilder()->getOne('admin_accounts', $select);
    }

    /**
     * Set friendly columns\' names to order tables\' entries
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'user_name' => 'Nombre de usuario',
            'admin_type' => 'Admin Type'
        ];

        return $ordering;
    }

    /**
     * Collect input
     */
    public function collect()
    {
        // Sanitize input post if we want
        $data_to_db = filter_input_array(INPUT_POST);

        return $data_to_db;
    }

    /**
     * Check username
     */
    public function check($data_to_db)
    {
        // Check whether the user name already exists
        $db = getDbInstance();
        $db->where('user_name', $data_to_db['user_name']);
        $db->get('admin_accounts');

        if ($db->count >= 1) {
            $this->failure('Este Nombre de Usuario ya existe');
        }
    }

    /**
     * Check email
     */
    public function check_email($data_to_db)
    {
        // Check whether the user name already exists
        $db = getDbInstance();
        $db->where('email', $data_to_db['email']);
        $db->get('admin_accounts');

        if ($db->count >= 1) {
            $this->failure('Email already exists');
        }
    }

    /**
     * Add user
     */
    public function add()
    {
        $data_to_db = $this->collect();
        $this->keep($data_to_db);
        $this->check($data_to_db);
        $this->check_email($data_to_db);
        $data_to_db['admin_type'] = 'user';
        $data_to_db['profile_pic'] = $this->upload();
        // Encrypting the password
        $data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
        // Reset db instance
        $db = getDbInstance();
        $last_id = $db->insert('admin_accounts', $data_to_db);

        if ($last_id) {
            $this->remove_temp_user($data_to_db['email']);
            $this->success('Admin user added successfully', 'user', $last_id);
        }
    }

    /**
     * Edit user
     *
     */
    public function update()
    {
        $data_to_db = $this->collect();
        $name = $this->upload();
        if (strlen($name)) {
            $data_to_db['profile_pic'] = $name;
        }
        
        // Reset db instance
        $db = getDbInstance();
        $db->where('id', $_SESSION['user_id']);
        $stat = $db->update('admin_accounts', $data_to_db);

        if ($stat) {
            $this->success('User updated successfully!');
        } else {
            $this->failure('Failed to update Admin user: ' . $db->getLastError());
        }
    }

    public function keep($data_to_db)
    {
        foreach ($data_to_db as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public function upload()
    {
        if ($_FILES['profile_pic']['error'] == 0) {
            $path_info = pathinfo($_FILES['profile_pic']['name']);
            $name = uniqid('profile_pic_').'.'.$path_info['extension'];
            $bool = move_uploaded_file($_FILES['profile_pic']['tmp_name'], 'upload/images/'.$name);
            if ($bool) {
                return $name;
            }
        }
    }

    public function remove_temp_user($email)
    {
        $db = getDbInstance();
        $db->where('email', $email);
        return $db->delete('temp_accounts');
    }

    /**
     * Delete user
     *
     */
    public function cancel($del_id)
    {
        if ($_SESSION['admin_type'] != 'super') {
            header('HTTP/1.1 401 Unauthorized', true, 401);
            exit("401 Unauthorized");
        }

        $db = getDbInstance();
        $db->where('id', $del_id);
        $stat = $db->delete('admin_accounts');

        if ($stat) {
            $this->info('User deleted successfully!');
        } else {
            $this->failure('Unable to delete user');
        }
    }

    /**
     * Flash message Failure process
     */
    public function failure($message, $location = 'Location: create_user_profile.php')
    {
        $_SESSION['failure'] = $message;
        // Redirect to the listing page
        header($location);
        // Important! Don't execute the rest put the exit/die.
        exit();
    }

    /**
     * Flash message Success process
     */
    public function success($message, $user_type=null, $user_id=0)
    {
        $_SESSION['success'] = $message;
        $_SESSION['user_logged_in'] = true;
        if ($user_type) {
            $_SESSION['admin_type'] = $user_type ;
        }
        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
        }
        // Redirect to the listing page
        header('Location: index.php');
        // Important! Don't execute the rest put the exit/die.
        exit();
    }

    /**
     * Flash message Info process
     */
    public function info($message)
    {
        $_SESSION['info'] = $message;
        // Redirect to the listing page
        header('Location: admin_user_profile.php');
        // Important! Don't execute the rest put the exit/die.
        exit();
    }
}
