<?php
    require_once('path.inc');
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');

    $client = new rabbitMQClient("AMD_Server.ini", "AMD_Server");

    $search_query = "";
    $search_result = array();

    if(isset($_POST['search_query'])){
        $search_query = $_POST['search_query'];
        $type = $_POST['type'];
        $request['type'] = $type;
        $request['name'] = $search_query;
        echo "hehehe";
        $response = $client->send_request($request);
        echo "haha";
        process_response($response);
        echo "this aint it sis";
    }

    function process_response($response){
        var_dump($response);
        echo "received request in search".PHP_EOL;
        $search_result = array();
        $search_result['type'] = $response['type'];
        $test = $search_result['name'];
        echo "this is from search . $test .";
        $search_result['name'] = $response['name'];
        $search_result['cal'] = $response['cal'];
        $search_result['pro'] = $response['pro'];
        $search_result['fat'] = $response['fat'];
        $search_result['carb'] = $response['carb'];

       return formatResult($search_result);

    }

    function formatResult($search_result){
        echo "<tr>";
        echo "<td><b>{$search_result['type']}</b></td></br>";
        echo "<td><b>{$search_result['name']}</b></td></br>";
        echo "<td> Calories: {$search_result['cal']}g</td></br>";
        echo "<td> Protein: {$search_result['pro']}g</td></br>";
        echo "<td> Fat: {$search_result['fat']}g</td></br>";
        echo "<td> Carbohydrates: {$search_result['carb']}g</td>";
        echo "</tr>";
    }





?>
<html>
<head></head>
    <body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
    <div>
    </div>

    </body>

</html>