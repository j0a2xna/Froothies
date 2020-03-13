<?php
        require_once('../backend/path.inc');
        require_once('../backend/get_host_info.inc');
        require_once('../backend/rabbitMQLib.inc');

        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

        $username = '';
        $email = '';
        $fruits = '';
        $veggies = '';
        $comments = '';
        $request = array();


        if(isset($_POST['username'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $fruits = $_POST['fruits'];
                $veggies = $_POST['veggies'];
                $comments = $_POST['comments'];

                $request['username'] = $username;
                $request['email'] = $email;

        }
        if(isset($_POST['submit'])){
                $request['type'] = 'submit';
                $response = $client->send_request($request);
                process_response($response);
        }

        function process_response($response){
                var_dump($response);
                if($response == "Your request is submitted."){
                        $suc_register = "You were successfuly submitted your request.";
                        echo "<script type='text/javascript'>
                                alert('$suc_register');
                                window.location = 'index.php';
                             </script>";
                }else{
                        $bad_register = "Sorry. This Fruit/Vegge already have been added. Please try again.";
                        echo "<script type='text/javascript'>
                                alert('$bad_register');
                                window.location = 'form.php';
                              </script>";
                }
        }
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>Froothies</title>

    <link href="home.css" type="text/css" rel="stylesheet" />
    <link href="home_style.css" type="text/css" rel="stylesheet" />
    <link href="form.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <header>
      <div class="row">
      <div class="col-25">
        <label name=search>For more information: </label>
      </div>
      <div class="col-75">
        <input type="text" id="search" name="search" placeholder="Search here..">
      </div>
    </div>
      <nav class="horizontalNavigation">
         <ul>
            <li><a href="welcome.php">Home</a></li>
            <li><a href="#">Fruits</a></li>
            <li><a href="#">Veggies</a></li>
            <li><a href="#">Protin</a></li>
            <li><a href="#">Contact Us</a></li>
            <div class="contact">
                <a href="logout.php">Logout</a>
            </div>
         </ul>
      </nav>
        
        <style>
            input[type=submit] {
                background-color: #4CAF50;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                float: right;
            }

        </style>
   </header>
<center>
<h2>Great! Now you can add your Favourite Fruits/Veggies.</h2>
</center>
<div class="container">
  <form action="./action.php">
    <div class="row">
      <div class="col-25">
        <label name=username>UserName</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="username" placeholder="Your name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label name="email">Email</label>
      </div>
      <div class="col-75">
        <input type="text" id="email" name="email" placeholder="Your email..">
      </div>
    </div>
      <!--<div class="row">
      <div class="col-25">
        <label for="country">Country</label>
      </div>
      <div class="col-75">
        <select id="country" name="country">
           <option value="country">-Select one-</option> 
          <option value="australia">Australia</option>
          <option value="canada">Canada</option>
          <option value="usa">USA</option>
        </select>
      </div>
    </div>-->
      <div class="row">
      <div class="col-25">
        <label name="fruits">Name of Fruit</label>
      </div>
      <div class="col-75">
        <input type="text" id="fruits" name="fruits" placeholder="Add fruit..">
      </div>
    </div>
      <div class="row">
      <div class="col-25">
        <label name="veggies">Name of Veggies</label>
      </div>
      <div class="col-75">
        <input type="text" id="veggies" name="vveggies" placeholder="Add veggies..">
      </div>
    </div>
    
    <div class="row">
      <div class="col-25">
        <label for="comments">Any comments?</label>
      </div>
      <div class="col-75">
        <textarea id="comments" name="comments" placeholder="Please leave your comments here.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>
</body>
</html>
