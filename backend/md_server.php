<?php
    require_once('md_cred.php');
    require_once('path.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("RMQ_Server.ini","RMQ_Server");
    

    $ingredient = '';
    $types = array("fruit", "veggies", "protein", "base");
    $query = array();
    $request = array();
    $response = array();

    if(isset($_POST['add'])){
        $type = $_POST['type'];
        addIngr($type, $ingredient);
    }
    

    function cRMQ(){
        $client = new rabbitMQClient("RMQ_Server.ini","RMQ_Server");
        return $client;
    }
    function sRMQ(){
        $server = new rabbitMQClient("AMD_Server.ini","AMD_Server");
        return $server;
    }

    function addIngr($type, $ingredient){
        $client = cRMQ();
        echo "add Ingr \n";
        $request['type'] = $type;
        $request['name'] = $ingredient;
        $response = $client->send_request($request);
        $query = process_response($response);
        return $query;
    }
    function connectDB(){
        $db_host = 'localhost';
        $db_username = 'admin';
        $db_password = 'adminpassword';
        $db_name = 'ingr';
        $mydb = new mysqli($db_host, $db_username,$db_password, $db_name);	
        return $mydb;

    }
    function queryDB($type, $name){
        $mydb = connectDB();
        $sql = "SELECT * from $type WHERE name = '$name'";
        $result = mysqli_query($mydb,$sql);
        echo "result is $result".PHP_EOL;

        if($result == FALSE){
            echo "result is FALSE";
            $query = addIngr($type, $name); 
            return $query;
        }else{
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $count = mysqli_num_rows($result);
            if($count > 0){
                $query['type']=$type;
                $query['name']=$row['name'];
                $test = $query['name'];
                $query['cal']=$row['calories'];
                $query['pro']=$row['protein'];
                $query['fat']=$row['fat'];
                $query['carb']=$row['carbs'];
                echo "IS THIS A QUERY .$test.";
                return $query;

            }else{
                echo "end of queryDB";
                return FALSE;
            }
        }
        
    }

    function process_response($response){
        var_dump($response);
        $array = array();
        $array = $response;
            $type = $response['type'];
            $name = $response['name'];
            $cal = $response['cal'];
            $pro = $response['pro'];
            $fat = $response['fat'];
            $carb = $response['carb'];
        
        echo "BIG BOY .$array.";
        $mydb = connectDB();
        $sql = "INSERT INTO '$type'(name, calories, protein, fat, carbs) VALUES ('$name', '$cal', '$pro', '$fat', '$carb')";
        $result = mysqli_query($mydb,$sql);
        return $response;

    }

    function requestProcessor($request){
        var_dump($request);
        $name = $request['name'];
        $type = $request['type'];

        echo "request reached";

        if(isset($request['type'])){
            $query = queryDB($type, $name);
            if($query == FALSE){
                echo "Sorry not found. Let's add it. link to form";
                
            }
        }
        return $query;
            
    }        

    $server = new rabbitMQServer("AMD_Server.ini","AMD_Server");
    $server->process_requests('requestProcessor'); 
    $server->send_request($query);
    exit();

?>
