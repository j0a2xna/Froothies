<?php 
	$db_host = 'localhost';
	$db_username = 'nemo';
	$db_password = 'dory123';
	$db_name = 'reef';

	$mydb = new mysqli($db_host, $db_username, $db_password, $db_name);	
	
	if(!$mydb)
	{
		die("Connection failed: ". msqli_connect_error());
	}else{
		echo "Successful connection";
	}
?>
