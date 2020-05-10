#!/usr/bin/php
<?php  
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    function connectDB(){
        $db = 'allrecipes';
        $db_host = '10.0.0.31';
        $db_username = 'nemo';
        $db_password = 'dory123';

        $conn = mysqli_connect($db_host, $db_username, $db_password, $db);
		if(!$conn){
			die ("Failed to connect" . mysqli_connect_error());
		}else{
			echo "Successful connection" . PHP_EOL;
		}
		return $conn;
    }

    function requestProcessor($request){
        var_dump($request);
        $username = $request['username'];
        $conn = connectDB();
        $sql = "SELECT username, recipe, fruit, veggies, protein, base FROM allrecipes";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
			$results = array();
			while($row = mysqli_fetch_array($result)){
				$results[] = $row;
			}
			print_r($results); 


			foreach($results as $test) {
				echo $test[0] . '<br>';
				echo $test[1] . '<br>';
				echo $test[2] . '<br>';
				echo $test[3] . '<br>';
                echo $test[4] . '<br>';
                echo $test[5] . '<br>';
			}
			return $results; 
		}else{
			echo "<h1>OOPS!</h1>";
			echo "<h2> $username --> You have not created any recipes! </h2>";
		}
        
    }
    $server = new rabbitMQServer("blog.ini","blogServer");
	$server->process_requests('requestProcessor');
    $server->send_request($row);
    ?>