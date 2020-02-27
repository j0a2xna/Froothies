<?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    #require_once('RMQ_server.ini');

    $APP_ID = '9e081409';
    $APP_KEY = 'c122653d4096a00999bf36f4e1d4958e';
    $url = '';
    $ch = curl_init();

    function requestProcessor($request){
        var_dump($request);
        if(isset($request['name'])){
            $food = $request['name'];
        }else{
            $food = 'apple';
        }
        
        $url = "https://api.edamam.com/api/food-database/parser?ingr='$food'&category=generic-foods&category-label=food&app_id='$APP_ID'&app_key='$APP_KEY'";

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $jsonData = curl_exec($ch);

        $jsonData = stripslashes(html_entity_decode($jsonData));
        $array = json_decode($jsonData, true);
        curl_close($ch);

        $response['name'] = $array['parsed'][0]['food']['label'];
        $response['cal'] = $array['parsed'][0]['food']['nutrients']['ENERC_KCAL'];
        $response['pro'] = $array['parsed'][0]['food']['nutrients']['PROCNT'];
        $response['fat'] = $array['parsed'][0]['food']['nutrients']['FAT'];
        $response['carb'] = $carb = $array['parsed'][0]['food']['nutrients']['CHOCDF'];

    }

    

    $server = new rabbitMQServer("RMQ_Server.ini","RMQ_Server");
    $server->process_requests('requestProcessor');
    $server->send_request($response);



?>