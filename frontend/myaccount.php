<?php
session_start();
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
	#	echo "here if process respoinse dsLKD";
		$username = $_SESSION['userid'];

		echo "<h1> Welcome $username!!</h1>"; //need to make sure we're getitng the user's name here. :)
		echo "<h2> Here are your recipes: </h2>";
#		echo "type is " . gettype($response) . "<br>";
		
		//if user does not have any recipes in their account, ask them to go to makesmoothie.php
		if($response == "[empty response]"){
			echo 'OOPS! You have not created any recipes yet! <a href="../../backend/makesmoothie.php"> Go here to create one <3 </a>';
		}
		//for each row(array), get the value in the column
		foreach($response as $test){
                                echo "<h3>" . $test[0] . "</h3>" . "<br>";
                                echo $test[1] . '<br>';
                                echo $test[2] . '<br>';
                                echo $test[3] . '<br>';
                                echo $test[4] . '<br>';
		}
/*
		echo "table in myaccount.php";
		echo "<table>";
                        echo "<tr>";
                        echo "<td>Name: </td>";
                        echo "<td>".$response["recipeName"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Fruits: </td>";
                        echo "<td>".$response["fruits"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Veggies: </td>";
                        echo "<td>".$response["veggies"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Protein: </td>";
                        echo "<td>".$response["protein"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Base</td>";
                        echo "<td>".$response["base"]."</td>";
                        echo "</tr>";

                        echo "</table>";

                        echo "******************************************";
 */

/*
		while($response = mysqli_fetch_assoc($result)){
                               echo "<table>";
                        echo "<tr>";
                        echo "<td>Name: </td>";
                        echo "<td>".$row["recipeName"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Fruits: </td>";
                        echo "<td>".$row["fruits"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Veggies: </td>";
                        echo "<td>".$row["veggies"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Protein: </td>";
                        echo "<td>".$row["protein"]."</td>";
                        echo "</tr>";

                        echo "<tr>";
                        echo "<td>Base</td>";
                        echo "<td>".$row["base"]."</td>";
                        echo "</tr>";

                        echo "</table>";

                        echo "******************************************";
                        }
 */
/*		echo "<table>";
                echo "<tr>";
                echo "<td>Name: </td>";
                echo "<td>".$response["recipeName"]."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Fruits: </td>";
                echo "<td>".$response["fruits"]."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Veggies: </td>";
                echo "<td>".$response["veggies"]."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Protein: </td>";
                echo "<td>".$response["protein"]."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Base</td>";
                echo "<td>".$response["base"]."</td>";
                echo "</tr>";

		echo "</table>";

		accountData($response);
 */		

		/*$row = $response;
		while($row){
			echo "<table>";
                echo "<tr>";
                echo "<td>Name: </td>";
                echo "<td>".$row["recipeName"]."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Fruits: </td>";
                echo "<td>".$row["fruits"]."</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Veggies: </td>";
                echo "<td>".$row["veggies"]."</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td>Protein: </td>";
                echo "<td>".$row["protein"]."</td>";
                echo "</tr>";

		echo "<tr>";
                echo "<td>Base</td>";
                echo "<td>".$row["base"]."</td>";
                echo "</tr>";

                echo "</table>";
               
                echo "******************************************";
		}*/
	}	

	function accountData($array){
		foreach($array as $key=>$value){
			if(is_array($value)){
				accountData($value);
			}else{
				echo $value, '<br>';
			}
		}
	}


/*
//start the session
session_start();
$username = $_SESSION['userid'];

// if user logged in, show page. if user not logged in, redirect them to the login page
if (isset($_SESSION['userid'])){
#echo $_SESSION['userid'];

	//db configuration
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

//*****************************************************

	// select columns from the table
	$sql = "SELECT recipeName, fruits, veggies, protein, base FROM $username";
	$result = mysqli_query($conn, $sql);

	//display all the recipes in the user's database. one per table
	if(mysqli_num_rows($result) > 0){
		echo "hello";
		echo "<h1>Welcome $username!!</h1>";
		while($row = mysqli_fetch_assoc($result)){
			echo "<table>";
			echo "<tr>";
     			echo "<td>Name: </td>";
			echo "<td>".$row["recipeName"]."</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>Fruits: </td>";
                	echo "<td>".$row["fruits"]."</td>";
			echo "</tr>";

			echo "<tr>";
                	echo "<td>Veggies: </td>";
                	echo "<td>".$row["veggies"]."</td>";
			echo "</tr>";

			echo "<tr>";
                	echo "<td>Protein: </td>";
                	echo "<td>".$row["protein"]."</td>";
                	echo "</tr>";

			echo "<tr>";
                	echo "<td>Base</td>";
                	echo "<td>".$row["base"]."</td>";
                	echo "</tr>";

	     		echo "</table>";
		
			echo "******************************************";
		}
	}
	if(mysqli_num_rows($result) == 0){
		echo "<h1>OOPS!</h1>";
		echo "<h2> $username --> You have not created any recipes! </h2>";
	}
	#else{
	#	echo "<OOPS!! You have not created any recipes yet!";
	#}
}
else{
	header("Location: index.php");
}
 */


?>




<html>
	<head>
        <title>My Account</title>
	</head>
    <body>
        <div class="myRecipes">
        </div>
       
    </body>
</html>
