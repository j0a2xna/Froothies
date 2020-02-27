<?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("RMQ_server.ini", "RMQ_Server");

    $search_query = "";
    $search_result = array();

    if(isset($_POST['search_query'])){
        $search_query = $_POST['search_query'];

        $request['type'] = 'search';
        $request['name'] = $search_query;
        $response = $client->send_request($request);
        process_response($response);
    }

    function process_response($search_result, $response){
        var_dump($response);
        $search_result['type'] = $response['type'];
        $search_result['name'] = $response['name'];
        $search_result['cal'] = $response['cal'];
        $search_result['pro'] = $response['pro'];
        $search_result['fat'] = $response['fat'];
        $search_result['carb'] = $response['carb'];

       formatResult($search_result);

    }

    function formatResult($search_result){
        echo "<tr>";
        echo "<td><b>{$search_result['name']}</b></td>";
        echo "<td> Calories: {$search_result['cal']}g</td>";
        echo "<td> Protein: {$search_result['pro']}g</td>";
        echo "<td> Fat: {$search_result['fat']}g</td>";
        echo "<td> Carbohydrates: {$search_result['carb']}g</td>";
        echo "</tr>";
    }




?>
<html>
<head></head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="search_query">
            <input type="submit" name="search" value="SEARCH">
        </form>


    </body>

</html>