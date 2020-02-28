<?php
	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');

	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	$username = '';
	$password = '';
	$request = array();
<<<<<<< HEAD

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

=======

	if(isset($_POST['username'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

>>>>>>> 0e79906e1c1d969cb94b8afec65c200c4952a662
   		$request['username'] = $username;
		$request['password'] = $password;

	}	
	if(isset($_POST['register'])){
		$request['type'] = 'register';
		$response = $client->send_request($request);
		process_response($response);
	}

	function process_response($response){
		var_dump($response);
		if($response == "registered"){
<<<<<<< HEAD
			$suc_register = "You were successfuly registered. Please log in.";
			echo "<script type='text/javascript'>
				alert('$suc_register');
				window.location = 'index.php';
			     </script>";
		}else{
			$bad_register = "Sorry. Username taken. Try again.";
			echo "<script type='text/javascript'>
				alert('$bad_register');
				window.location = 'register.php';
			      </script>";
=======
				echo "you have successfully registered\n".PHP_EOL;
		}else{
				echo "sorry username taken\n".PHP_EOL;
>>>>>>> 0e79906e1c1d969cb94b8afec65c200c4952a662
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
			<div id="register">		
				<b>Register</b>
			</div>
			<div id="cred">
				<form name="" action="" method="POST">
					Username: 
					<input type="text" name="username" id="box" autocomplete="off" required/>
				</br></br>
					Password: 
					<input type="password" name="password" id="box" autocomplete="off" required/>
<<<<<<< HEAD
				</br></br>
					Email address:
					<input type="email" name="email" id="box" autocomplete="off" required/>
				</br></br>
					<input type="Submit" value="Register" name="register"/>
				</form>			
=======
				</br></br>
					Email address:
					<input type="email" name="email" id="box" autocomplete="off" required/>
				</br></br>
					<input type="Submit" value="Register" name="register"/>
				</form>
			
>>>>>>> 0e79906e1c1d969cb94b8afec65c200c4952a662
					<div style="font-size:12px;color:#000000;margin-top:10px">
						Already have an account? <a href="index.php">Log in here!</a>
					</div>
			</div>
		</div>
	</div>
	</body>
</html>
<<<<<<< HEAD
=======

>>>>>>> 0e79906e1c1d969cb94b8afec65c200c4952a662
