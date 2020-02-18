<?php
	session_start();

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');

	$error= "ready?";
	$client = new rabbitMQClient("/backend/testRabbitMQ.ini","testServer");

	$username = '';
	$password = '';
	$request = array();

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

   		$request['username'] = $username;
		$request['password'] = $password;
		
		echo "here 1".PHP_EOL;
	}	
	if(isset($_POST['login'])){
		echo "in login".PHP_EOL;
		$request['type'] = 'login';
		$response = $client->send_request($request);
		process_response($response);
	}

	if(isset($_POST['register'])){
		echo "in register".PHP_EOL;
		$request['type']='register';
		$response = $client->send_request($request);
		process_response($response);
	}

	function process_response($response){
		echo "Received response".PHP_EOL;
		var_dump($response);
		if($response == "login"){
			echo "Successfully Logged in\n".PHP_EOL;
			session_start();
			session_register("username");
			$_SESSION['userid']=$username;
			echo $_SESSION['userid'];
			header("location: welcome.php");
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
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
	<div align="center">	
		<div id="dialog">					
			<div id="login">		
				<b>Login</b>
			</div>
			<div id="cred">
				<form name="" action="" method="POST">
					Username: 
					<input type="text" name="username" id="box" autocomplete="off"/>
				</br></br>
					Password: 
					<input type="password" name="password" id="box" autocomplete="off"/>
				</br></br>
					<input type="Submit" value="Submit" name="login"/>
					<input type="Submit" name="register" value="Register"/>
				<br/>
				</form>
			
					<div style="font-size:11px;color#000000;margin-top:10px">
						Error:	<?php echo $error.PHP_EOL; ?>
		
					</div>
			</div>
		</div>
	</div>
	</body>
</html>

