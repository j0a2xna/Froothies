<?php
    session_start();
    if($_SERVER["QUERY_STRING"]){
        session_destroy();
    }
?>

<html>
        <head>
                <title> Log out </title>
                <style>
                        body{
                                background-image: url("fruits-bg.png");
                                text-align: center;
                        }

                        div.message {
                                position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%);
                                border: 3px solid pink;
                                border-style: dashed;
                                border-radius: 15px;
                                background-color:white;
                                color:teal;
                                font-family: Arial, Helvetica, sans-serif;
                                padding:50px;
                        }
                </style>
        </head>
        <body>
                <div class="message">
                        <h1>Successfully logged out. We'll miss you!</h1>
                        <h4><a href="index.php">Go back to Log In</a></h4>
                </div>
        </body>
</html>
