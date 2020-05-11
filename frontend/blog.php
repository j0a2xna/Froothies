<?php
/* this page is for blogging */
session_start();
if(isset($_SESSION['userid'])){

}else{
	header("Location: ../frontend/index.php");
}

	require_once('../backend/path.inc');
	require_once('../backend/get_host_info.inc');
	require_once('../backend/rabbitMQLib.inc');
	
	//set the timezone from new york
	date_default_timezone_set('America/New_York');

	$username = $_SESSION['userid'];

	$client = new rabbitMQClient("blog.ini", "blogServer");
	if(isset($_SESSION['userid'])){
		$request['username'] = $username;
		$response = $client -> send_request($request);
		process_response($response);
	}

	function process_response($response){
		$username = $_SESSION['userid'];
		echo '<div class="navbar">';
                echo '<a href="../frontend/welcome.php"><i class="fa fa-fw fa-home"></i> Home</a>';
                echo '<a href="../frontend/myaccount.php" id="acc"><i class="fa fa-fw fa-envelope"></i> My Account</a>';
                echo '<a href="../frontend/logout.php" id="log"><i class="fa fa-fw fa-user"></i> Log Out</a> ';
                echo '</div>';

		// created div for the greeting because it was looping inside foreach
		echo '<div class="greetingSuccess">';
		echo "<h1> Hello, $username!!</h1>";
		echo "<h2> You can see all your recipes below </h2>";
		echo "</div>";

		 //if user does not have any recipes in their account, ask them to go make a smoothie in the welcome page
                if($response == "[empty response]"){
                        echo '<div class="greetingNOSuccess">';
                        echo 'This is empty! <a href="../frontend/welcome.php"> Go here to create one smoothie. <3 </a>';
                        echo "</div>";
                }

		//for each row(array), get the value in the column
		foreach($response as $column){
				echo '<div class="oneRecipe">';
				echo "<h3>Made By: " . $column[0] . "</h3>" . "<br>";
                echo "Recipe Name: " . $column[1] . '<br>';
                echo "Fruit: " . $column[2] . '<br>';
                echo "Vegetable: " . $column[3] . '<br>';
                echo "Protein: " . $column[4] . '<br>';
                echo "Base: " . $column[5] . '<br>';
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
				        data-href="https://froothies.net" 
				        data-layout="button_count">
				      </div>
    
					<!-- twitter button + smoothie info in it -->	
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
						<a href="https://twitter.com/share?ref_src=twsrc%5Etfw"
							class="twitter-share-button"
							data-text="Take a look at this awesome smoothie recipe! <?php echo ' Made By: ' . $column[0] . '. Recipe Name: ' . $column[1] . '. Fruit: ' . $column[2] . '. Vegetable: ' . $column[3] . '. Protein: ' . $column[4] . '. Base: ' . $column[5];?>"
							data-hashtags="froothies" 
							data-related="" 
							data-show-count="true">Tweet
						</a>
				    </p>
				 </div>
			</div></div>
		<?php echo "
			<form>
				  <input type='hidden' name='uid' value='$username'>
				  <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
				  <textarea name='message'></textarea>
				  <button type='submit' name='submit'>Comment</button>
			</form> ";
			}
	} ?>



<html>
	<head>
	<title>Blogging</title>
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
