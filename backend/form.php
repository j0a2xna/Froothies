<?php
        $servername= "localhost";
        $user = "nemo";
        $password = "dory123";
        $db = "form";

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
        mysqli_close($connect);

?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Froothies</title>

    <link href="home.css" type="text/css" rel="stylesheet" />
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link href="form.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <header>
      <!--div class="row">
      <div class="col-25">
        <label name=search>For more information: </label>
      </div>
      <div class="col-75">
        <input type="text" id="search" name="search" placeholder="Search here..">
      </div>
    </div>
      <nav class="horizontalNavigation">
         <ul>
            <li><a href="welcome.html">Home</a></li>
            <li><a href="#">Fruits</a></li>
            <li><a href="#">Veggies</a></li>
            <li><a href="#">Protin</a></li>
            <li><a href="#">Contact Us</a></li>
            <div class="contact">
                <a href="logout.php">Logout</a>
            </div>
         </ul>
      </nav-->

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
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
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
        <input type="text" id="veggies" name="veggies" placeholder="Add veggies..">
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
      <input type="submit" name="submit" id="submit" value="Submit">
    </div>
  </form>
</div>
</form>

</body>
</html>

<!--meta charset="UTF-8">
<style>
    .dashRed { display : none; border:  2px dashed red;}
    form
    {
        border-radius: 50px;
        border:  solid pink;
        outline: 3px solid blue;
        padding: 20px;
        width: 50%;
        margin: auto;
        margin-top: 30px;
    }
    .data input { margin-left: 20em; }
    .data button { background-color: aquamarine; font-size: 20px; }
    .data label { margin-left: 1em; position: absolute; }
    .data textarea { margin-left: 17em;}
    .optionmenu label { margin-left: 1em; position: absolute; }
    .optionmenu select{ margin-left: 13em;}
</style>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

<div  class="data"> 

    <label><b>Great! Now you can add your favorite fruit/vegies here. </b></label>

    <br><br><label>Enter your Username<br></label>
        <input type="text" name="username" placeholder="Enter here">

    <br><br><label>Enter your Email<br></label>
        <input type="text" name="email" Id="amount" placeholder="Enter here">

    <br><br><label>Enter your favourite Fruit<br></label>
        <input type="text" name="fruits" Id="amount" placeholder="Enter here">
<br><br>

        <label>Enter your favourite Veggies<br></label>
            <input type="text" name="veggies"  Id="amount" placeholder="Enter here"><br><br>

    <label>Do you have any Comments?<br></label>

    <textarea name="comments" rows="5" cols="30" placeholder="Please enter here"></textarea>
<br><br>  <center>
    <button type="submit" name="submit" id="submit" value="submit"><b>Submit</b></button><br></center>
</div>
</form-->
