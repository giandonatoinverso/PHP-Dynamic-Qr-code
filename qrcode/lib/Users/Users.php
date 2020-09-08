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

class Users
{
    /**
     *
     */
    public function __construct()
    {   
        // Only super admin is allowed to access this page
        if ($_SESSION['admin_type'] !== 'super')
            $this->failure('Only a "super admin" account can access the admin listing page', 'Location: index.php');
    }

    /**
     *
     */
    public function __destruct()
    {
    }
    
    /**
     * Set friendly columns\' names to order tables\' entries
     */
    public function setOrderingValues()
    {
        $ordering = [
            'id' => 'ID',
            'user_name' => 'Username',
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

	    if ($db->count >= 1)
		    $this->failure('Username already exists');
    }
    
    /**
     * Add user
     */
    public function add()
    {
        $data_to_db = $this->collect();
        $this->check($data_to_db);
        
        // Encrypting the password
	    $data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
	    // Reset db instance
	    $db = getDbInstance();
	    $last_id = $db->insert('admin_accounts', $data_to_db);

	    if ($last_id)
		    $this->success('Admin user added successfully');
		
    }
    
    /**
     * Edit user
     * 
     */
    public function edit()
    {
        $data_to_db = $this->collect();
        
        // Check whether the user name already exists
	    $db = getDbInstance();
	    $db->where('user_name', $data_to_db['user_name']);
	    $db->where('id', $admin_user_id, '!=');
	    $row = $db->getOne('admin_accounts');

	    if (!empty($row['user_name']))
	    {
		    $query_string = http_build_query(array(
			    'admin_user_id' => $admin_user_id,
			    'operation' => $operation,
		    ));
		    $this->failure('Username already exists', 'Location: edit_admin.php?'.$query_string);
	    }

	    $admin_user_id = filter_input(INPUT_GET, 'admin_user_id', FILTER_VALIDATE_INT);
	    // Encrypting the password
	    $data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
	    // Reset db instance
	    $db = getDbInstance();
	    $db->where('id', $admin_user_id);
	    $stat = $db->update('admin_accounts', $data_to_db);
        
        if ($stat)
            $this->success('User updated successfully!');
        else
            $this->failure('Failed to update Admin user: ' . $db->getLastError());
    }
    
    /**
     * Delete user
     * 
     */
    public function cancel($del_id)
    {
        if($_SESSION['admin_type']!='super'){
            header('HTTP/1.1 401 Unauthorized', true, 401);
            exit("401 Unauthorized");
        }
        
        $db = getDbInstance();
        $db->where('id', $del_id);
        $stat = $db->delete('admin_accounts');

        if ($stat)
            $this->info('User deleted successfully!');
        else
            $this->failure('Unable to delete user');
    }
    
    /**
     * Flash message Failure process
     */
    public function failure($message, $location = 'Location: admin_users.php')
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
    public function success($message)
    {
        $_SESSION['success'] = $message;
        // Redirect to the listing page
        header('Location: admin_users.php');
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
        header('Location: admin_users.php');
        // Important! Don't execute the rest put the exit/die.
    	exit();
    }
}
?>
