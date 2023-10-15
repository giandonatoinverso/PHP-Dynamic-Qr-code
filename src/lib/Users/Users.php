<?php
require_once 'config/config.php';

class Users
{
    /**
     *
     */
    public function __construct()
    {   
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

    public function getUser($id) {
        $db = getDbInstance();

        $db->where('id', $id);
        $result = $db->getOne(DATABASE_PREFIX.'admin_accounts');

        if($result !== NULL)
            return $result;
        else
            $this->failure("User not found");
    }
    
    /**
     * Add user
     */
    public function addUser($input_data) {
        $db = getDbInstance();

        $data_to_db["user_name"] = $input_data["user_name"];
        $data_to_db['password'] = password_hash($input_data['password'], PASSWORD_DEFAULT);
        $data_to_db["admin_type"] = $input_data["admin_type"];

        $db->where('user_name', $data_to_db['user_name']);
        $db->get('admin_accounts');

        if ($db->count >= 1)
            $this->failure('Username already exists');

	    $last_id = $db->insert('admin_accounts', $data_to_db);

	    if ($last_id)
		    $this->success('User added successfully');
    }
    
    /**
     * Edit user
     * 
     */
    public function editUser($input_data) {
        $db = getDbInstance();

        $db->where('user_name', $input_data['user_name']);
        $db->where('id', $input_data["id"], '!=');
        $row = $db->getOne('admin_accounts');

        if (!empty($row['user_name']))  {
            $query_string = http_build_query(array(
                'id' => $input_data["id"],
                'edit' => "true",
            ));
            $this->failure('Username already exists', 'Location: admin_user.php?'.$query_string);
        }

        $data_to_db["user_name"] = $input_data["user_name"];
        $data_to_db['password'] = password_hash($input_data['password'], PASSWORD_DEFAULT);
        $data_to_db["admin_type"] = $input_data["admin_type"];

	    $db->where('id', $input_data["id"]);
	    $stat = $db->update('admin_accounts', $data_to_db);
        
        if ($stat)
            $this->success('User updated successfully!');
        else
            $this->failure('Failed to update User: ' . $db->getLastError());
    }
    
    /**
     * Delete user
     * 
     */
    public function deleteUser($id) {
        if($_SESSION['admin_type']!='super'){
            header('HTTP/1.1 401 Unauthorized', true, 401);
            exit("401 Unauthorized");
        }
        
        $db = getDbInstance();
        $db->where('id', $id);
        $stat = $db->delete('admin_accounts');

        if ($stat)
            $this->info('User deleted successfully!');
        else
            $this->failure('Unable to delete user');
    }
    
    /**
     * Flash message Failure process
     */
    public function failure($message, $location = 'Location: admin_users.php') {
        $_SESSION['failure'] = $message;
        header($location);
    	exit();
    }
    
    /**
     * Flash message Success process
     */
    public function success($message) {
        $_SESSION['success'] = $message;
        header('Location: admin_users.php');
    	exit();
    }
    
    /**
     * Flash message Info process
     */
    public function info($message) {
        $_SESSION['info'] = $message;
        header('Location: admin_users.php');
    	exit();
    }
}
?>
