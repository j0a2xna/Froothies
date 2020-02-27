<?php
	#include('session.php');
	require_once('path.inc');
        require_once('get_host_info.inc');
        require_once('rabbitMQLib.inc');
        require_once('loginDB.php');


	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

	if(isset($_POST['username'])){
		$username = mysqli_real_escape_string($mydb,$_POST['username']);
		$password = mysqli_real_escape_string($mydb,$_POST['password']);
		$email = mysqli_real_escape_string($mydb,$_POST['email']);
		$sql = "INSERT into users ('username','password','email') VALUES ('$username', '$password', '$email')";

		$result = mysqli_query($mydb,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);  
		$active = $row['active'];
                $count = mysqli_num_rows($result);

		if($count == 1){	
			echo "you have successfully registered";
		}

	}
?>
<html>
	<head>
	<title> Register </title>
	</head>
	<body>
		<div align="center">
			<div style = "width:300px; border:solid 1px #000000;" align="left">
				<div style ="background-color:#eCC1C5;color:#ffffff;padding:10px;text-align:center;">
					<b>Login</b>
				</div>
			<div style="margin:32px">
				<form name="login" action="" method="POST">
					Username: 
					<input type="text" name="username" class="box" autocomplete="off"/>
				</br></br>
					Password: 
					<input type="password" name="password" class="box" autocomplete="off"/>
				</br></br>
					<input type="Submit" value="Submit"/>
					<button name="Register" value="Register"/>Register</button>
				<br/>
				</form>
			
				<div style="font-size:11px;color#000000;margin-top:10px">
					Error:	<?php echo $error.PHP_EOL; ?>
		
				</div>
			</div>
		</div>
	</body>

