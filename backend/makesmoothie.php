<?php
	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');


	function connectDB($db_name){
		#*****************************#
		#connect to allrecipes[db] allrecipes[table] to insert info given by the user
		#****************************#
		$db = $db_name;
		$db_host='localhost';
		$db_username='nemo';
		$db_password='dory123';

		#test connection
		$conn = mysqli_connect($db_host, $db_username, $db_password, $db);
		return $conn;
	}


	function requestProcessor($request){
		var_dump($request);
		$username = $request['username'];
		$recipe_name = $request['recipe'];
		$fruit = $request['fruit'];
		$veggies = $request['veggies'];
		$protein = $request['protein'];
		$base = $request['base'];
		
		$db_name ='allrecipes';
		$conn = connectDB($db_name);
		$sql = "INSERT INTO TABLE allrecipes VALUES('$username', '$recipe_name', '$fruit', '$veggies', '$protein', '$base')";
		$result = mysqli_query($conn,$sql);

		#*****************************#
			#connect to users[db] $username[table] to insert info given by the user
		#****************************#
		$db_name2 = 'users';
		$conn2 = connectDB($db_name2);
		$sql2 = "INSERT INTO TABLE $username VALUES('$recipe_name', '$fruit', '$veggies', '$protein', '$base')";
		$result2 = mysqli_query($conn2,$sql2);

		$response = "SUCCESS.";
		return $response;
	}

	$server = new rabbitMQServer("recipe.ini","recipe_server");
	$server->process_requests('requestProcessor');
	$server->send_request($response);
?>


