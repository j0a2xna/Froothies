<?php
	//start session and see if user is logged in
session_start();
if(isset($_SESSION['userid'])){

}else{
        header("Location: ../frontend/index.php");
}
   	require_once('../backend/path.inc');
    	require_once('../backend/get_host_info.inc');
   	require_once('../backend/rabbitMQLib.inc');




/**
//start session and see if user is logged in
session_start();
if(isset($_SESSION['userid'])){
	
}else{
	header("Location: ../frontend/index.php");
}**/
?>

<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">


    <head>
        <meta charset="utf-8"> <!-- utf-8 works for most cases -->
        <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
        <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        <link rel="stylesheet" href="../frontend/css/nav.css">
        <link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
        <link rel="stylesheet" type="text/css" href="../frontend/css/style1.css">
    </head>

    <body>
        <div class="navbar">
            <a href="../frontend/welcome.php">Home</a>
            <a href="../frontend/indexrating.php">Rating</a>
            <a href="../frontend/myaccount.php" id="acc">My Account</a>
            <a href="../frontend/logout.php" id="log">Log Out</a>
                <form action="../backend/search.php" method="post" id="form">
                    <select name="type" id="type" class="sel"> 
                            <option value="recipes" name="recipes"> ALL RECIPES
                            <option value="fruit" name="fruit"> FRUIT
                            <option value="veggies" name="veggies"> VEGGIES
                            <option value="protein" name="protein"> PROTEIN
                            <option value="base" name="base"> BASE
                    </select>
                    <input type="text" name="search_query">
                    <input type="submit" name="search" value="SEARCH">
                </form>
        </div>

        <div id="day">
               <a href="../frontend/recommendSmoothie.php"><h2>SMOOTHIE OF THE DAY</h2></a>
        </div>
        <div id="make">
            <div id="fDiv">
                <form action="../frontend/recipe.php" method= "post">
                    <b> Make a Smoothie </b><br>
                        <b>Give your Recipe a Name:</b><br> <input type="text" id="RecipeName" name="recipe"><br>

                        <b>Fruit:</b><br> <input type="text" id="ingr" name="fruit"> <input type="button" value="Add" id="add" name="fruit"/><br>

                        <b>Veggies:</b><br> <input type="text" id="ingr" name="veggies"> <input type="button" value="Add" id="add" name="veggies"/><br>

                        <b>Protein:</b><br> <input type="text" id="ingr" name="protein"> <input type="button" value="Add" id="add" name="protein"/><br>

                        <b>Base:</b><br> <input type="text" id="ingr" name="base"> <input type="button" value="Add" id="add" name="base"/><br>
                        <input type="Submit" value="ADD RECIPE" name="submit"/>
                </form> 
            </div>
        </div>
        <div id="recommend">
            <form action="../frontend/form.php" method="POST">
                <div class="row">
                    <div>
                <h4>Recommend fruits and veggies</h4>
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
              <input type="submit" id="submit" name="submit" value="Submit">
            </div>
            </form>
        </div>

        <div class = "data">

            <form action="../frontend/comment.php" method="POST">
                <link rel="../frontend/recommendSmoothie.php">
                  <h3> Do you like our page?</h3>
                  <h3>Leave Us a Comment </h3>

                  <br><label>Enter your Name<br></label>
                  <input type="text" name="username" placeholder="Enter here"><br><br>

                  <label>Enter your comments<br><br></label>

                  <textarea name="comments" rows="5" cols="20" placeholder="Please enter here"></textarea>      

                  <button type="submit" name="submit" value="submit"><b>Submit</b></button><br>
            </form>

        </div>
        
        <!-- 
   SOCIAL MEDIA PLUGINS TO SHARE OUR PAGE. THIS IS AT THE BOTTOM
-->

  <!-- FACEBOOK start -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }
    (document, 'script', 'facebook-jssdk'));
  </script>

  <div class="socialMediaFooter">
    <p>
      <div class="fb-share-button" 
        data-href="https://froothies.com" 
        data-layout="button_count">
      </div>
    
    <!-- FACEBOOK end -->
    
    <!-- TWITTER start -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    
      <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" 
        class="twitter-share-button" 
        data-text="Checkout this page!" 
        data-url="https://froothies.com" 
        data-hashtags="froothies" 
        data-related="" 
        data-show-count="true">Tweet
      </a>
        </div>
    
    </body>
</html>

