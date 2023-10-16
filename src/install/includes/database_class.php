<?php
class Database {

	// Function to the database and tables and fill them with the default data
	function create_database($db_host, $db_user, $db_password, $db_name, $db_port)
	{
		// Connect to the database
		$mysqli = new mysqli($db_host,$db_user,$db_password,'', $db_port);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Create the prepared statement
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$db_name);

		// Close the connection
		$mysqli->close();

		return true;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($db_host, $db_user, $db_password, $db_name, $db_port, $db_prefix)
	{
		// Connect to the database
        $mysqli = new mysqli($db_host,$db_user,$db_password,$db_name, $db_port);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Open the default SQL file
		$query = file_get_contents('sql/sample_data.sql');

        // Run prefix regex; if none is set, then it will replace #prefix# with an empty string.
        $query = preg_replace('/#prefix#/', $db_prefix, $query);

		// Execute a multi query
		$mysqli->multi_query($query);

		// Close the connection
		$mysqli->close();

		return true;
	}
}
