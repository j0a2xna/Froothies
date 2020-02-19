<?php 
	$db_host = '192.168.56.5';
	$db_username = 'nemo';
	$db_password = 'dory123';
	$db_name = 'reef';

	$mydb = new mysqli($db_host, $db_username, $db_password, $db_name);	
	
	if($mydb->errno != 0)
	{
		echo "failed to connect.". $mydb->error . PHP_EOL;
		echo "failed.".PHP_EOL;
	}else{
		echo "we in.".PHP_EOL;	}
?>
