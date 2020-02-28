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
        addIngr($ingredient, $type);
    }

    $server = new rabbitMQServer("AMD_Server.ini","AMD_Server");
    $server->process_requests('requestProcessor');
    $server->send_request($response);


    function addIngr($ingredient, $type){
        $ingredient = $_POST['ingrediant'];
        echo "add Ingr";
        $num = queryDB($type, $ingredient);

        if(is_array($num)){
            print_r($row);
            return $num;
        }else{
            $request['type'] = 'fruit';
            $request['name'] = $ingredient;
            $response = $client->send_request($response);
            process_response($response);
        }

    }
    function queryDB($type, $name){
        $db_host = 'localhost';
        $db_username = 'admin';
        $db_password = 'adminpassword';
        $db_name = 'ingr';

        $mydb = new mysqli($db_host, $db_username,$db_password, $db_name);	
        
        if(!$mydb)
        {
            die("Connection failed: ". msqli_connect_error());
        }else{
            echo "Successful connection";
        }

        $sql = "SELECT * from '$type' WHERE name = '$name'";
        $result = mysqli_query($mydb,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $query = array();

        if($count == 1){
            $query['type']=$type;
            $query['name']=$row['name'];
            $query['cal']=$row['cal'];
            $query['pro']=$row['pro'];
            $query['fat']=$row['fat'];
            $query['carb']=$row['carb'];
            return $query;
        }else{
            return $count;
        }
    }

    function processs_response($response){
        var_dump($response);
        $type = $response['type'];
        $name = $response['name'];
        $cal = $response['cal'];
        $pro = $response['pro'];
        $fat = $response['fat'];
        $carb = $response['carb'];

        $sql = "INSERT INTO '$type'(name, calories, protein, fat, carbs) VALUES ('$name', '$cal', '$pro', '$fat', '$carb')";
        $result = mysqli_query($mydb,$sql);
    }

    function requestProcessor($request){
        var_dump($request);

        $types = array("fruit", "veggies", "protein", "base");

        $name = $request['name'];
        $type = $request['type'];

        echo "request reached";

        if($request['type']=="search"){
            foreach ($types as $table){
                $query = queryDB($table, $name);
                echo "query result: . $query .";
            }
            echo "inside search request";
            
        }else{
            return addIngr($name,$type);
        }
            
    }        

    
    exit();

?>
