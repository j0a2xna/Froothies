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
    if(isset($_POST['add'])){
      
      
    }

    function RMQ(){
      $client = new rabbitMQClient("AMD_Server.ini", "AMD_Server");
      return $client;
    }

    function add($type, $name){
      $client = RMQ();
      $request['name'] = $name;
      $request['type'] = $type;

      $response = $client->send_request($request);
      process_response($response);
    }

    function process_response($reponse){
      $ingredient = array();
      $ingredient['type'] = $response['type'];
      $ingredient['name'] = $response['name'];
      $ingredient['cal'] = $response['cal'];
      $ingredient['pro'] = $response['pro'];
      $ingredient['fat'] = $response['fat'];
      $ingredient['carb'] = $response['carb'];

      return addResult($ingredient);
    }

    function addResult($ingredient){
      echo "<div style='float:right;' class='ingr'><br><ul>";
      echo "<li><b>{$ingredient['type']}</li>";
      echo "<li>{$ingredient['name']}</li>";
      echo "<li>{$ingredient['cal']}</li>";
      echo "<li>{$ingredient['pro']}</li>";
      echo "<li>{$ingredient['fat']}</li>";
      echo "<li>{$ingredient['carb']}</li>";
      echo "</ul>";
    }

      
?>



