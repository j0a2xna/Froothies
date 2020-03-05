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
      echo "$response";
    }

      
?>



