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
<meta charset="UTF-8">
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

    <label>Do you have any omments?<br></label>

    <textarea name="comments" rows="5" cols="30" placeholder="Please enter here"></textarea>
<br><br>  <center>
    <button type="submit" name="submit" id="submit" value="submit"><b>Submit</b></button><br></center>
</div>
</form>
