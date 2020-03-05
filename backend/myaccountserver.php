<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');
	
	function connectDB(){
		//db config
		$db_host = 'localhost';
		$db_username = 'nemo';
		$db_password = 'dory123';
		$db_name = 'reef';

		//test db connection
		$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
		if(!$conn){
			die ("Failed to connect" . mysqli_connect_error());
		}else{
			#echo "Successful connection" . PHP_EOL;
		}

		return $conn;
	}

	function requestProcessor($request){
		$username = $request['username'];
		$conn = connectDB();
		$sql = "SELECT recipeName, fruits, veggies, protein, base FROM $username";
		$result = mysqli_query($conn, $sql);
		/*
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			return $row;
		}
		*/

	}

	$server = new rabbitMQServer("account.ini","accountServer");
	$server->process_requests('requestProcessor');
	$server->send_request($row);
?>
