#!/usr/bin/php
<?php

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');


	$db_host='localhost';
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

	$db_host='localhost';
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
	$count = mysqli_num_rows($result);

	echo "here 3".PHP_EOL;
	if($count == 1){
		echo "we're logged in B".PHP_EOL;
		print_r($row);
		$send = "login";
		return $send;
	}
	$send = "fail";
	return $send;
}

function doRegister($username, $password){
	if((doLogin($username, $password)) == "login"){
		$send = "taken";
		return $send;
	}else{
			$db_host='localhost';
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

				if(mysqli_query($mydb, $sql)){
                        echo "user created successfully".PHP_EOL;
                }else{
                        "Error creating user: " . mysqli_error($mydb) . PHP_EOL;
                }

		$sql2 = "CREATE TABLE `".$username."`(recipe_name VARCHAR(255) NOT NULL, fruit VARCHAR(255), veggies VARCHAR(255), protein VARCHAR(255), base VARCHAR(255), PRIMARY KEY(recipeName))";

		
		//test query against database
		if(mysqli_query($mydb, $sql2)){
			echo "table created successfully".PHP_EOL;
		}else{
			"Error creating table: " . mysqli_error($mydb) . PHP_EOL;
		}
		if((doLogin($username, $password)) == "login"){
			$send = "registered";
			return $send;
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
