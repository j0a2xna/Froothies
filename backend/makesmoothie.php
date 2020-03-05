<?php
	session_start();

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');

	$username = $_SESSION['userid'];


	function requestProcessor($request){
		$username = $_SESSION['userid'];
		$recipeName = $request['Recipe'];
		$fruits = $request['Fruit'];
		$vegetables = $request['Vegetables'];
		$protein = $request['Protein'];
		$base = $request['Base'];
		
		#*****************************#
		#connect to allrecipes[db] allrecipes[table] to insert info given by the user
		#****************************#
		$db_host='localhost';
		$db_username='nemo';
		$db_password='dory123';
		$db_name1='allrecipes';

		#test connection
		$conn1 = mysqli_connect($db_host, $db_username, $db_password, $db_name1);
		if(!$conn1){
				die ("Failed to connect" . mysqli_connect_error());
		}else{
				#echo "Successful connection" . PHP_EOL;
		}

		$sql1 = "INSERT INTO TABLE allrecipes(username, recipe_name, fruit, veggies, protein, base) VALUES('$username', '$recipe_name', '$fruit', '$veggies', '$protein', '$base')";

		if(mysqli_query($conn1, $sql1)){
			echo "Inserted into table successfully.";
		}else{
				echo "ERROR: Could not able to execute $sql1. " . mysqli_error($conn1);
		}

		mysqli_close($conn1);

		#*****************************#
			#connect to reef[db] $username[table] to insert info given by the user
			#****************************#
		$db_host='localhost';
		$db_username='nemo';
		$db_password='dory123';
		$db_name2='reef';

		#test connection
		$conn2 = mysqli_connect($db_host, $db_username, $db_password, $db_name2);

		if(!$conn2){
				die ("Failed to connect" . mysqli_connect_error());
		}else{
				#echo "Successful connection" . PHP_EOL;
		}

		$sql2 = "INSERT INTO TABLE `".$username."` VALUES('$username', '$recipe_name', '$fruit', '$veggies', '$protein', '$base')";
		if(mysqli_query($conn2, $sql2)){
				echo "Inserted data into table successfully".PHP_EOL;
			}else{
					echo "Error creating table: " . mysqli_error($conn2) . PHP_EOL;
			}
	}

	$server = new rabbitMQServer("recipe.ini","recipe_server");
	$server->process_requests('requestProcessor');
	$server->send_request($response);
?>


