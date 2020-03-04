<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');
	
	$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
	$server->process_requests('requestProcessor');
	$server->send_request($row);

	function requestProcessor($request){
		$username = $request['username'];

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

		$sql = "SELECT recipeName, fruits, veggies, protein, base FROM $username";
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_assoc($result);
			return $row;
		}
	}
?>
