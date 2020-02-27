<?php
//start the session
session_start();

//db configuration
$db_host = 'localhost';
$db_username = 'nemo';
$db_password = 'dory123';
$db_name = 'profile';

//test db connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if(!$conn){
	die ("Failed to connect" . mysqli_connect_error());
}else{
	echo "Successful connection";
}

//*****************************************************//

$username=$_SESSION['username'];

// select columns from the table
$sql = "SELECT id, publicationDate, title, ingredients, instructions FROM recipes";
$result = mysqli_query($conn, $sql);

//display all the recipes in the database
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		echo "id: " . $row["id"] . " - Publication Date: " . $row["publicationDate"] . " Recipe Title: " . $row["title"] . " Ingredients: " . $row["ingredients"] . " Instructions: " . $row["instructions"] . "<br>";
	}
}else{
	echo "0 results";
}


?>

<html>
	<head>
        <title>My Account</title>
	</head>
    <body>
        <div class="myRecipes">
            <h1>My Recipes</h1>
            Recipe Name
            <br><input type="text" placeholder="name.." id="repName"><br><br>
            Ingredients
            <br><textarea name="" id="repIng" cols="20" rows="10"></textarea><br><br>
            Instructions 
            <br><textarea name="" id="repInst" cols="20" rows="10"></textarea>
	    <br><br><button type="button">Add recipe</button>
	    <?php echo "$username" ?>
        </div>
       
    </body>
</html>
