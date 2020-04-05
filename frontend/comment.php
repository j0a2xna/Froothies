<?php
    session_start();
        if(isset($_SESSION['userid'])){

        }else{
                header("Location: ../frontend/index.php");
        }
        require_once('../backend/path.inc');
        require_once('../backend/get_host_info.inc');
        require_once('../backend/rabbitMQLib.inc');

        $username=$_SESSION['userid'];

        $client = new rabbitMQClient("comment.ini","commentServer");

        if(isset($_POST['submit'])){
              $username = $_POST['username'];
              $comments=$_POST['comments'];


                $request = array();
                $request['username'] = $username;
                $request['comments'] = $comments;

                $response = $client->send_request($request);
        }
?>


