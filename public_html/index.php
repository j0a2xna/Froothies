<?php
	session_start();

	require_once('path.inc');
	require_once('get_host_info.inc');
	require_once('rabbitMQLib.inc');
	#require_once('loginDB.php');

	$error= "ready?";
	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

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
		$request['error']=$error;
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
		if($response){
			echo "Successfully Logged in".PHP_EOL;
		}else{
			echo "sorry username/password incorrect".PHP_EOL;
		}
	}
	
?>
<html>
	<head>
	<title> Login </title>

		<style type="text/css">
			body{
				font-family:Arial,Helvetica,sans-serif;
				font-size:14px;
			}
			.box{
				border:#ffffff solid 2px;
				border-radius:25px;
			}
		</style>
	</head>
	
	<body bgcolor="#ffffff">
		<div align="center">
			<div style = "width:300px; border:solid 1px #000000;" align="left">
				<div style ="background-color:#eCC1C5;color:#ffffff;padding:10px;text-align:center;">
					<b>Login</b>
				</div>
			<div style="margin:32px">
				<form name="" action="" method="POST">
					Username: 
					<input type="text" name="username" class="box" autocomplete="off"/>
				</br></br>
					Password: 
					<input type="password" name="password" class="box" autocomplete="off"/>
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
	</body>
</html>

