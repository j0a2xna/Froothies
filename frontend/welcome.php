<?php

session_start();

if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['username'];
}

echo $_SESSION['username'] . PHP_EOL;

?>

<!DOCTYPE html>
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

        <title>Welcome IT490</title>

<style>
    
    html,
    body {
        margin: 0 auto !important;
    padding: 0 !important;
    height: 100% !important;
    width: 100% !important;
    /*background-image: url(bc.jpg);
        background-size: cover;*/
    }
    .dashRed { display : none; border:  2px dashed red;}
    form
    {
        color: chocolate;
        /*border-radius: 50px;
        border:  solid pink;
        outline: 3px solid blue;
        padding: 20px;
        width: 100%;
        margin: auto;
        margin-top: 30px; */
    }

    .data2 { position: absolute; z-index: 2;}
    
    .data h1 { color: red;}
    .data button {margin-left: 1em; font-size: 25px; font-style: bold; background-color: yellow;}
    .data table h2,h4 { margin-left: auto; }
    .data table h3,h5 { margin-right: auto;}
    .text-services {
        padding-left: 1em;
        padding-right: 1em;}
    
    .text-services h2 {
        color: darkcyan;
    }
    
    .menu {
        background-color: #333;
        overflow: hidden;
    }
    .menu1 {
        background-color: #fff;
        overflow: hidden;
        text-align: right;
        float: right;
        font-size: 17px;
        padding-right: 1em;
    }

    /* Style the links inside the navigation bar */
    .menu a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    /* Change the color of links on hover */
    .menu a:hover {
        background-color: #ddd;
        color: black;
    }

    /* Add a color to the active/current link */
    .menu a.active {
        background-color: #4CAF50;
        color: white;
    }
    /*.menu .cnc {
        text-align: right;
        padding-right: 1em;
    }*/
    .contact a:hover{
        font-size: 25px;
        color: red;
        text-decoration: underline;}
    .cnc {
        color: blue; 
    }
    .contact {
        text-align: right;
        float: right;
    }
    .img-container {
        color: darkblue;
        position: center;
    }
    .img-container h2 {
        color: black;
        
    }
</style>
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #222222;">
	<center style="width: 100%; background-color: #ffffff;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
      
    </div>
        
    <div class="data" style="background-image: url(bc.jpg);"></div>
    <header>
        <div class="menu">
            <a class="active" href="#all">All</a>
            <a href="#vegan">Vegan</a>
            <a href="#healthy">Healthy</a>
            <a href="#protin">Protein</a>
            <a href="#cnc">Contact Us</a>
	    <div class="contact"><a href="myaccount.php">My Account</a><a href="logout.php">Logout</a></div>  
        </div>
        <div class="menu1">
            <lable><b>Search here for more imformation: </b></lable><input type="text"  name="search" placeholder="Serach for more information">
        </div>
        
    </header>
    
<div class="data" >
    <br>
    <b><h1>Choose Your Own Froothies   <button type=button id="Search" value="Search">Search</button></h1></b><br>
        
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
		            		<tr>
		            			<td valign="top" width="25%" style="padding-top: 20px;" >
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td class="text-services">
                            	<h2>Today's Recomandation</h2>
                                <p>Spinach Cucumber Smoothies</p> 
                                <img src="img1.jpg" style="background-color: white" class="data2">
                                <!--<p1><br>(Limited time only)</p1>-->
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="center" width="25%" style="padding-top: 120px; padding-left: 1em;" >
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td class="text-services">
                            	
                             	<p>Spinach</p>
                                <p>Cucumber</p>
                                <p><a href="login.html"> Click Here</a></p>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="top" width="25%" style="padding-top: 20px;" >
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td class="text-services">
                            	<h2>Smoothie of the day</h2>
                              <p> Mango Carrot Smoothie</p>
                                <img src="img1.jpg" class="data2">
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td valign="center" width="25%" style="padding-top: 120px; padding-left: 1em;" >
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                          <tr>
                            <td class="text-services">
                            	
                             	<p>Mango</p>
                                <p>Carrot</p>
                                <p><a href="login.html"> Click Here</a></p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
            
		  </table>
    </div> 
    <br><br><br><br><br><br>
    <form action="form.html" method="GET">
        
        <div id="form1" class="data">
            <label>Can't find your choice of food? To add <a href="form.html">Click Here</a></label><br><br><br>
        </div>
    </form> 
    
    <table>
       <tr valign="middle" class="data" style="background-image: url(img1.jpg); background-size:cover; height: 400px; text-align: center;">
                        <td valign="center" width="25%" style="padding-top: 10px; padding-left: 1em;" >
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                               
                            <tr>
                              <td>  
                                  <div class="img-container" style="text-align: center;">
                                    <h2>How are you feeling today?
                                        <button onclick="good()">Good</button>
                                        <button onclick="sad()">Sad</button>
                                        <img id="img-area" width="100%" height="100%" src="">
                                    </h2>
                                  </div>
                                </td>
                              </tr>
                                
                            </table>
                          </td>
        </tr>
    </table>
    
    <footer>
        <div class="cnc" id="cnc" style="text-align: center; ">
         
        <br><br>
        
        <h2>Contact Us</h2>
        
            Kruti Patel &#9830; <a href="tel: 123-123-1234"> 123-123-1234 </a> &#9830; <a href="mailto: kcp39@njit.edu"> kcp39@njit.edu </a>
        </div>
    </footer>

    
    </center>     
</body>
</html>
