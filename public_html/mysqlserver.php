#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('loginDB.php');


	$db_host='192.168.56.5';
        $db_username='nemo';
        $db_password='dory123';
        $db_name='reef';

        $mydb = new mysqli($db_host, $db_username, $db_password, $db_name);

        if($mydb->errno != 0){
                echo "failed to connect.".$mydb->error . PHP_EOL;
        }else{
                echo "we in.".PHP_EOL;
        }


function doLogin($username, $password){
	echo "here 5".PHP_EOL;

	$db_host='192.168.56.5';
	$db_username='nemo';
	$db_password='dory123';
	$db_name='reef';

	$mydb = new mysqli($db_host, $db_username, $db_password, $db_name);

	if($mydb->errno != 0){
		echo "failed to connect.".$mydb->error . PHP_EOL;
	}else{
		echo "we in.".PHP_EOL;
	}

	$sql ="SELECT * from users WHERE username = '$username' 
		AND password = '$password'";
	$result = mysqli_query($mydb,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//$active=$row['active'];
	$count = mysqli_num_rows($result);

	echo "here 3".PHP_EOL;
	if($count == 1){
		echo "we're logged in B".PHP_EOL;
		#session_register("username");
		#$_SESSION['login_user']=$username;
		print_r($row);
		$send = true;
		return $send;
	}
	$send = false;
	return $send;
}

function doRegister($username, $password){
	if(doLogin($username, $password)){
		echo "Sorry username taken";
	}else{
		$db_host='192.168.56.5';
 	        $db_username='nemo';
       		$db_password='dory123';
	        $db_name='reef';

	        $mydb = new mysqli($db_host, $db_username, $db_password, $db_name);

	        if($mydb->errno != 0){
               		 echo "failed to connect.".$mydb->error . PHP_EOL;
	        }else{
        	        echo "we in register function.".PHP_EOL;
	        }

		$sql = "INSERT INTO users (username,password) VALUES ('$username','$password')";
		$result =  mysqli_query($mydb,$sql);
	        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

		if(doLogin($username, $password)){
			echo "successfully registered.".PHP_EOL;
		}

	}

}

function requestProcessor($request){
	echo "received request".PHP_EOL;
	var_dump($request);
	if(!isset($request['type'])){
		return "ERROR: I aint got no type";
	}
	switch ($request['type']){
		case "login":
			return doLogin($request['username'],$request['password']);
		case "validate_session":
			return doValidate($request['sessionId']);
		case "register":
			return doRegister($request['username'],$request['password']);
	}
	
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
$server->process_requests('requestProcessor');
$server->send_request($send);
exit();

?>
