<?php
	session_start();

	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');

	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$username = '';
	$password = '';
	$request = array();

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

   		$request['username'] = $username;
		$request['password'] = $password;

	}	
	if(isset($_POST['login'])){
		$request['type'] = 'login';
		$response = $client->send_request($request);
		process_response($response);
	}

	function process_response($response){
		var_dump($response);
		if($response == "login"){
			session_start();
#			session_register("username");
			$_SESSION['userid']=$_POST['username'];
			header('location: welcome.php');
		}elseif($response == "fail"){
				echo "sorry username/password incorrect\n".PHP_EOL;
		}elseif($response == "registered"){
				echo "you have successfully registered\n".PHP_EOL;
		}else{
				echo "sorry username taken\n".PHP_EOL;
		}
	}
	
?>
<html>
	<head>
	<title> Login </title>
		<link rel="stylesheet" type="text/css" href="../frontend/style.css">
	</head>
	<body>
	<div align="center">	
		<div id="dialog">					
			<div id="login">		
				<b>Log in</b>
			</div>
			<div id="cred">
				<form name="" action="" method="POST">
					Username: 
					<input type="text" name="username" id="box" autocomplete="off"/>
				</br></br>
					Password: 
					<input type="password" name="password" id="box" autocomplete="off"/>
				</br></br>
					<input type="Submit" value="Log in" name="login"/>
				<br/>
				</form>
			
					<div style="font-size:12px;color:#000000;margin-top:10px">
						Not a member? <a href="register.php">Create an account!</a>
					</div>
			</div>
		</div>
	</div>
	</body>
</html>

