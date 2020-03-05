<?php
//start session and see if user is logged in
session_start();
if(isset($_SESSION['userid'])){
	
}else{
	header("Location: ../frontend/index.php");
}
?>

<html lang="en" xmlns="http://srlwebmail.com/index.php" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

    <head>
<meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    
    <script type="text/javascript">
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                var originalAddEventListener = EventTarget.prototype.addEventListener,
                    oldWidth = window.innerWidth;

                EventTarget.prototype.addEventListener = function (eventName, eventHandler, useCapture) {
                    if (eventName === "resize") {
                        originalAddEventListener.call(this, eventName, function (event) {
                            if (oldWidth === window.innerWidth) {
                                return;
                            }
                            else if (oldWidth !== window.innerWidth) {
                                oldWidth = window.innerWidth;
                            }
                            if (eventHandler.handleEvent) {
                                eventHandler.handleEvent.call(this, event);
                            }
                            else {
                                eventHandler.call(this, event);
                            };
                        }, useCapture);
                    }
                    else {
                        originalAddEventListener.call(this, eventName, eventHandler, useCapture);
                    };
                };
            };
</script>

        <title>Welcome to Froothies</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../frontend/css/nav.css">

<div class="navbar">
  <a href="../frontend/index.php"><i class="fa fa-fw fa-home"></i> Home</a>
            
                <select name="type" id="type" class="sel"> 
                    <option value="recipes" name="recipes"> ALL RECIPES
                    <option value="fruit" name="fruit"> FRUIT
                    <option value="veggies" name="veggies"> VEGGIES
                    <option value="protein" name="protein"> PROTEIN
                    <option value="base" name="base"> BASE
                </select>
            <form action="../backend/search.php" method="post">
            <input type="text" name="search_query">
            <input type="submit" name="search" value="SEARCH">
            <a href="../frontend/myaccount.php"><i class="fa fa-fw fa-envelope"></i> My Account</a>
            <a href="../frontend/logout.php"><i class="fa fa-fw fa-user"></i> Log Out</a>
         </form>
  
</div>

</body>
</html>