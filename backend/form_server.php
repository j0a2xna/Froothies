<?php
        require_once('../backend/path.inc');
        require_once('../backend/get_host_info.inc');
        require_once('../backend/rabbitMQLib.inc');

        $servername= "localhost";
        $user = "nemo";
        $password = "dory123";
        $db = "form";

        $types = array("username", "email", "fruits", "veggies", "comments");
         $query = array();
        $request = array();
        $response = array();

        $connect = mysqli_connect($servername, $user, $password, $db);

        if (!$connect){
                die("Connecting Failed: " . mysqli_connect_error());
        }

        if(isset($_POST['submit'])){

                $username = $_POST['username'];
                $email = $_POST['email'];
                $fruits = $_POST['fruits'];
                $veggies = $_POST['veggies'];
                $comments = $_POST['comments'];

                $sql = "INSERT INTO addFruit (username, email, fruits, veggies, comments) VALUES ('$username', '$email', '$fruits', '$veggies', '$comments')";
if (mysqli_query($connect, $sql)){
                        echo "New record created successfully";
                }
                else
                {
                        echo "Error: " .$sql . "<br>" . mysqli_error($connect);
                }
        }

        function doRegister($username, $password){
        if((doLogin($username, $email)) == "form"){
$send = "taken";
                return $send;
        }else{
                $servername='localhost';
                $user='nemo';
                $password='dory123';
                $db='form';

                $mydb = new mysqli($servername, $user, $password, $db);

                if($mydb->errno != 0){
                         echo "failed to connect.".$mydb->error . PHP_EOL;
                }else{
                        echo "we in register function.".PHP_EOL;
                }
        }
        }


        function requestProcessor($request){
                echo "received request".PHP_EOL;
                var_dump($request);
                if(!isset($request['type'])){
                        return "ERROR: I aint got no type";
                }
                switch ($request['type']){
                        case "form":
                                return doRegister($request['username'],$request['email'],$request['fruits'],$request['veggies'],$request['comments']);
        }
}
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
$server->process_requests('requestProcessor');
$server->send_request($send);
exit();


        mysqli_close($connect);
?>
