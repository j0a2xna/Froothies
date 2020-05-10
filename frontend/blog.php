<?php   
 //displays all recipes from database
    session_start();
    if(isset($_SESSION['userid'])){
        
    }else{
        header("Location: ../frontend/index.php");
    }

//required header
    require_once('../backend/path.inc');
    require_once('../backend/get_host_info.inc');
    require_once('../backend/rabbitMQLib.inc');

//grab current user from sessions
    $username = $_SESSION['userid'];

//initialize new RMQ client
    $client = new rabbitMQClient("blog.ini", "blogServer");
    if(isset($_SESSION['userid'])){
        $request['username'] = $username;
        $response = $client -> send_request($request);
        process_response($reponse);
        echo "in frontend" . gettype($results);
    }

    function process_response($response){
        $username = $_SESSION['userid'];
        //format and print navbar in html
        echo '<div class="navbar">';
            echo '<a href="../frontend/welcome.php"><i class="fa fa-fw fa-home"></i> Home </a>';
            echo '<a href="../frontend/myaccount.php" id="acc"><i class="fa fa-fw fa-envelope"></i> My Account</a>';
            echo '<a href="../frontend/logout.php" id="log"><i class="fa fa-fw fa-user"></i> Log Out</a> ';
            echo '</div>';

        //echos greeting upon response
        echo '<div class="greetingSuccess">';
        echo "<h1> Hello, $username!!</h1>";
        echo '<h2> You can see all YOUR recipes on <a href="../frontend/myaccount.php" id="acc"><i class="fa fa-fw fa-envelope"></i> My Account</a></h2>';
        echo gettype($response);
        echo "</div>";
       
        //if the user has no recipes, link to create one
        if($response == "[empty response]"){
            echo '<div class="greetingNOSuccess">';
            echo 'OOPS! You have not created any recipes yet! <a href="../frontend/welcome.php"> Go here to create one <3 </a>';
            echo "</div>";
        }

        

        foreach($response as $column){
            echo "<h2>hello im in foreach<h2>";
            echo '<div class="oneRecipe">';
            echo "<h3>Recipe Name: " . $column[0] . "</h3>" . "<br>";
                            echo "Fruits: " . $column[1] . '<br>';
                            echo "Vegetables: " . $column[2] . '<br>';
                            echo "Protein: " . $column[3] . '<br>';
                            echo "Base: " . $column[4] . '<br>';
                            echo "Made by: " . $column[5] . '<br>'; //will display other users usernames
         


?>
    <!-- facebook button -->
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

				  <div class="socialMediaMyAccount">
				    <p>
				      <div class="fb-share-button" 
				        data-href="https://froothies.com" 
				        data-layout="button_count">
				      </div>
    
					<!-- twitter button + smoothie info in it -->	
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						<a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
							class="twitter-share-button"
							data-text="Take a look at this awesome smoothie recipe! <?php echo ' Recipe Name: ' . $column[0] . '. Fruits: ' . $column[1] . '. Vegetables: ' . $column[2] . '. Protein: ' . $column[3] . '. Base: ' . $column[4];?>"
							data-hashtags="froothies" 
							data-related="" 
							data-show-count="true">Tweet
						</a>
				    </p>
				 </div>
			</div></div>
		<?php	}
	} ?>
<html>
	<head>
	<title>My Account</title>
	<link rel="stylesheet" href="../frontend/css/nav.css">
	<link rel="stylesheet" type="text/css" href="../frontend/css/style.css">
	<meta property="og:description" content="Tutorials, thoughts, and random stuff ♥" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
        	.oneRecipe{
			top: 50%;
			left: 50%;
			background-color:white;
                        border: 3px solid pink;
                        border-style: dashed;
                        border-radius: 15px;
			padding:50px;
			}
		.greetingSuccess{
			top: 50%;
                        left: 50%;
                        background-color:#77DD77;
			border: 3px #FDFD96;
                        border-style: dashed;
                        border-radius: 15px;
                        padding:50px;
		}
		.greetingNOSuccess{
			top: 50%;
                        left: 50%;
                        background-color:#77DD77;
                        border: 3px #FDFD96;
                        border-style: dashed;
                        border-radius: 15px;
                        padding:50px;
		}

        </style>

	</head>
    <body>
      
    </body>
</html>

