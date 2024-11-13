	<?php 
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'mdCAYABYABapril112003');
	define('DB_NAME', 'ssprout_db');

	$db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	if ($db == false){
		die("ERROR: Couldn't connect: " . $db->connect_error);
	}
	?>