<?php
    require_once('../backend/path.inc');
    require_once('get_host_info.inc');
    require_once('../backend/rabbitMQLib.inc');

    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");

    $search_query = "";
    $search_result = array();

    if(isset($_POST['search_query'])){
        $search_query = $_POST['search_query'];

        $request['type'] = 'search';
        $request['name'] = $search_query;
        $response = $client->send_request($response);
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

        foreach($search_result[0] as $category){
            echo $category . "\n";
        }

    }




?>
<html>
<head></head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="submit" name="search_query" value="SEARCH">
        </form>
    </body>

</html>