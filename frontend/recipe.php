<?php
  session_start();
  $username = $_SESSION['userid'];

  require_once('../backend/path.inc');
  require_once('../backend/get_host_info.inc');
  require_once('../backend/rabbitMQLib.inc');
  
  $client = new rabbitMQClient("recipe.ini", "recipe_server");
   
    if(isset(_POST['submit'])){
      $recipe=$_POST['Recipe'];
      $fruit=$_POST['Fruit'];
      $vegetable=$_POST['Vegetables'];
      $protein=$_POST ['Protein'];
      $base=$_POST ['Base'];
    }
	 
	 
    $request = array();
    $request['username'] = $username;
    $request['recipe'] = $recipe;
    $request['fruit'] = $fruit;
    $request['vegetable'] = $vegetable;
    $request['protein'] = $protein;
    $request['base'] = $base;
    
    $response = $client->send_request($request);
    echo "$response";
	
?>

<html>
<head>
<style>
h2 {
   color: blue;

   }
 h3 {
   color: tomato;
   }
 b{
    color: tomato;

        }


 </style>


<center><h2>Lets Make Some Froothies!!!!</h2></center><br><br>

<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method= "post">

  <b>Give your Recipe a Name:</label></b> <input type="text" id="RecipeName" name="Recipe"><br>

  <h3>Fruit:</label><br> <input type="text" id="FruitName" name="Fruit" > <button class="btn add" onclick="alert('Added!')">ADD</button><br>
  
  <h3>Vegetables:</label><br> <input type="text" id="VegetableName" name="Vegetables"> <button class="btn add" onclick="alert('Added!')">ADD</button><br>
  
  <h3>Protein:</label><br> <input type="text" id="ProteinName" name="Protein">  <button class="btn add" onclick="alert('Added!')">ADD</button><br>
  
  <h3>Base:</label><br> <input type="text" id="BaseName" name="Base"> 
  <input type="Submit" value="ADD RECIPE" name="submit"/>
</form> 


</body>
</html>


