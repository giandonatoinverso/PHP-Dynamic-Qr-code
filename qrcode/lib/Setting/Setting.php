<?php

class Setting
{
    private $table = 'social_setting';

    /**
     * Collect input
     */
    public function collect()
    {
        // Sanitize input post if we want
        $data_to_db = filter_input_array(INPUT_POST);

        return $data_to_db;
    }

    public function check($data_to_db)
    {
        // Check whether the user name already exists
        $db = getDbInstance();
        $db->where('provider', $data_to_db['provider']);
        $db->get($this->table);

        if ($db->count >= 1) {
            $this->failure('Provider already exists', 'Location: add_setting.php');
        }
    }

    /**
     * Add user
     */
    public function edit()
    {
        $data_to_db = $this->collect();
        $social_id = $_GET['id'];
        $operation = $_GET['operation'];
        
        $db = getDbInstance();
        $db->where('provider', $data_to_db['provider']);
        $db->where('id', $social_id, '!=');
        $row = $db->getOne($this->table);
        if (!empty($row['provider'])) {
            $query_string = http_build_query(array(
                'admin_user_id' => $social_id,
                'operation' => $operation,
            ));
            $this->failure('Provider already exists', 'Location: edit_setting.php?'.$query_string);
        }

        // Encrypting the password
        
        // Reset db instance
        $db = getDbInstance();
        $db->where('id', $social_id);
        $last_id = $db->update($this->table, $data_to_db);

        if ($last_id) {
            $this->success('Setting added successfully', 'user', $last_id);
        }
    }

    /**
     * Add user
     */
    public function add()
    {
        $data_to_db = $this->collect();
        $this->check($data_to_db);
        
        // Encrypting the password
        
        // Reset db instance
        $db = getDbInstance();
        $last_id = $db->insert($this->table, $data_to_db);

        if ($last_id) {
            $this->success('Setting added successfully', 'user', $last_id);
        }
    }

    /**
     * Flash message Failure process
     */
    public function failure($message, $location = 'Location: setting_list.php')
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
        
        // Redirect to the listing page
        header('Location: setting_list.php');
        // Important! Don't execute the rest put the exit/die.
        exit();
    }
}
