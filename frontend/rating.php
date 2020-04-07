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

        $client = new rabbitMQClient("rating.ini","ratingServer");

        if(isset($_POST['submit'])){
         #     $username = $_POST['username'];
	    
	      $smoothie=$_POST['smoothie'];
	      $rating=$_POST['rating'];
	    


                $request = array();
              #  $request['username'] = $username;
                $request['smoothie'] = $smoothie;
		$request['rating'] = $rating;
		
		$response = $client->send_request($request);
        }
?>

<html>
        <head>
                <title> Smoothie Ratings</title>
                <style>
                        body{
                                background-image: url("/var/www/froothies/assets/fruits-bg.png");
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
           padding:50px;
                        }
                </style>
        </head>
        <body>
                <div class="rating">
                         <form action= "rating.php" method  ='POST'>
				echo "hey '$userid',Enter the name of the smoothie you want to rate: 
				 <textarea name="ratings"  placeholder="Please enter here"></textarea><br><br>
 
					$smoothie: <select name = 'rating'>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                </select>
                                <input type = 'hidden' value='$id' name ='smoothie'>
                                <input type ='submit' value= 'Rate'> Current Rating: "; echo $hits; echo ">
                                </form>

                        <h4><a href="../frontend/welcome.php">Go to home page</a></h4>
                </div>
        </body>
</html>


								   
