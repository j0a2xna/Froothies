<?php
/* this page is showing the user's Account (Only the recipes they have created) :)
 * it pulls from the table with their name created through register.php and inserted in makesmoothie.php
 */
session_start();
if(isset($_SESSION['userid'])){

}else{
	header("Location: ../frontend/index.php");
}

/*echo "here at least";*/

	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');
	
	$username = $_SESSION['userid'];
/*	echo "im a client my account"; */

	$client = new rabbitMQClient("account.ini", "accountServer");
	if(isset($_SESSION['userid'])){
		$request['username'] = $username;
		$response = $client -> send_request($request);
		process_response($response);
	}

	function process_response($response){
		$username = $_SESSION['userid'];
		//if user does not have any recipes in their account, ask them to go to makesmoothie.php
		if($response == "[empty response]"){
			echo 'OOPS! You have not created any recipes yet! <a href="../frontend/welcome.php"> Go here to create one <3 </a>';
		}

		echo '<div class="navbar">';
                                echo '<a href="../frontend/welcome.php"><i class="fa fa-fw fa-home"></i> Home</a>';
                                echo '<a href="../frontend/myaccount.php" id="acc"><i class="fa fa-fw fa-envelope"></i> My Account</a>';
                                echo' <a href="../frontend/logout.php" id="log"><i class="fa fa-fw fa-user"></i> Log Out</a> ';
                                echo' </div>';

		// created div for the greeting because it was looping inside foreach
		echo '<div class="greeting">';
		echo "<h1> Hello, $username!!</h1>"; //need to make sure we're getitng the user's name here. :)
		echo "<h2> You can see all your recipes below </h2>";
		echo "</div>";
		//for each row(array), get the value in the column
		foreach($response as $column){
				echo '<div class="oneRecipe">';
				echo "<h3>Recipe Name: " . $column[0] . "</h3>" . "<br>";
                                echo "Fruits: " . $column[1] . '<br>';
                                echo "Vegetables: " . $column[2] . '<br>';
                                echo "Protein: " . $column[3] . '<br>';
				echo "Base: " . $column[4] . '<br>';
                                //echo "<hr>";
				echo "</div>";
		}
	}
?>

<html>
	<head>
	<title>My Account</title>
	<link rel="stylesheet" href="../frontend/css/nav.css">
        <link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
	<style>
        	.oneRecipe{
			top: 50%;
			left: 50%;
			background-color:white;
                        border: 3px solid pink;
                        border-style: dashed;
                        border-radius: 15px;
			padding:50px;
			}
		.greeting{
			top: 50%;
                        left: 50%;
                        background-color:#77DD77;
			border: 3px #FDFD96;
                        border-style: dashed;
                        border-radius: 15px;
                        padding:50px;
		}

        </style>

	</head>
    <body>
      
    </body>
</html>
