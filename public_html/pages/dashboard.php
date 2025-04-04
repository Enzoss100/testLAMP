<?php
	echo "Welcome ", $_POST['name'], ", this is the dashboard of the website",'<br?';
	// Correct relative path to the DB
	$db_path = __DIR__ . '/../database/app.db';

	// Create or open the SQLite3 database
	$db = new SQLite3($db_path);

	// Check if it connected properly
	if (!$db) {
		die("Failed to connect to the database.");
	} 
	else {
		echo "Connected successfully!";
	}

?>
