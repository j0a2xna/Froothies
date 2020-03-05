<?php
  session_start();
  $username = $_SESSION['userid'];

  require_once('../backend/path.inc');
  require_once('../backend/get_host_info.inc');
  require_once('../backend/rabbitMQLib.inc');
  
  $client = new rabbitMQClient("recipe.ini", "recipe_server");
   
    if(isset($_POST['submit'])){
      $recipe=$_POST['recipe'];
      $fruit=$_POST['fruit'];
      $vegetable=$_POST['veggies'];
      $protein=$_POST['protein'];
      $base=$_POST['base'];

      $request = array();
      $request['username'] = $username;
      $request['recipe'] = $recipe;
      $request['fruit'] = $fruit;
      $request['veggies'] = $vegetable;
      $request['protein'] = $protein;
      $request['base'] = $base;
      
      $response = $client->send_request($request);
    }

      
?>

<html>
<head>
    <style>
      .fDiv{
        float: left;
      }
      .list{
        float: right;
      }
      h1{
        font-family: Helvetica;
      }
      
    </style>
    <script> 
      document.getElementById("add").onclick = function(){
        var text = document.getElementById("ingr").value;
        var li = "<li>" + text + "</li>";
        document.getElementById("smoothie").appendChild(li);
      }
    </script>
    <link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
</head>
<center><h2>Lets Make Some Froothies!!!!</h2></center><br><br>

<body>
<header>
        <div class="menu">
            <form action="../backend/search.php" method="post">
                <select name="type" id="type"> 
                    <option value="recipes" name="recipes"> ALL RECIPES
                    <option value="fruit" name="fruit"> FRUIT
                    <option value="veggies" name="veggies"> VEGGIES
                    <option value="protein" name="protein"> PROTEIN
                    <option value="base" name="base"> BASE
                </select>
            <input type="text" name="search_query">
            <input type="submit" name="search" value="SEARCH">
        </form>
            
	   <a href="myaccount.php">My Account</a><a href="logout.php">Logout</a>
    </div>
        
    </header>
  <div id="fDiv">
      <form action="" method= "post">

        <b>Give your Recipe a Name:</label></b> <input type="text" id="RecipeName" name="recipe"><br>

        <h4>Fruit:</label><br> <input type="text" id="ingr" name="fruit"> <input type="button" value="Add To Smoothie" id="add"/><br>
        
        <h4>Veggies:</label><br> <input type="text" id="ingr" name="veggies"> <input type="button" value="Add To Smoothie" id="add"/><br>
        
        <h4>Protein:</label><br> <input type="text" id="ingr" name="protein"> <input type="button" value="Add To Smoothie" id="add"/><br>
        
        <h4>Base:</label><br> <input type="text" id="ingr" name="base"> <input type="button" value="Add To Smoothie" id="add"/><br>
        <input type="Submit" value="ADD RECIPE" name="submit"/>
      </form> 
    </div>
    <div id="list">
      <ul id="smoothie"></ul>
    </div>

</body>
</html>


