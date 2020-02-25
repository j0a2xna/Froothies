<?php
    require_once('md_cred.php');
    require_once('path.inc');
    require_once('rabbitMQLib.inc');


    $client = new rabbitMQClient("RMQ_server.ini","RMQ_Server");

    $ingredient = '';
    $type = '';
    $request = array();
    $response = array();

    if(isset($_POST['add'])){
        $type = $_POST['type'];
        addIngr($ingredient, $type);
    }

    function addIngr($ingredient, $type){
        $ingredient = $_POST['ingrediant'];

        $sql = "SELECT * from '$type' WHERE name = '$ingredient'";
                $result = mysqli_query($mydb,$sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

            if($count == 1){
                print_r($row);
                return $count;
            }else{
                $request['type'] = 'fruit';
                $request['name'] = $ingredient;
                $response = $client->send_request($response);
                process_response($response);
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
                
    $server = new rabbitMQServer("testRabbitMQ.ini","testServer");
    $server->process_requests('requestProcessor');
    $server->send_request($response);


?>
