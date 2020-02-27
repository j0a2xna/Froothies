<?php

session_start();
$db_host = 'localhost';
$db_username = 'nemo';
$db_password = 'dory123';
$db_name = 'profile';

$mydb = new mysqli($db_host, $db_username, $db_password, $db_name);
if($mydb -> errno != 0){
	echo "Failed to connect" . $mydb;
}else{
	echo "Successful connection";
}

?>

<html>
	<head>
	</head>
</html>
