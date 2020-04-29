
<?php
//index.php
session_start();
        if(isset($_SESSION['userid'])){

        }else{
                header("Location: ../frontend/index.php");
        }
     

        $username=$_SESSION['userid'];
?>
<!DOCTYPE html>
<html>
 <head>
  <title>All Recipes</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link rel="stylesheet" href="style.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>


  
  <style="color: red; font-weight: bold;">
  <input type="hidden" id="user_id" value="<?php echo $_SESSION ['userid'];?>"/>



  <div class="container" style="width:800px;">
   <h2 align="center">All Recipes</h2>

<!-- Showing message after sending email -->
<?php session_start(); if (isset($_SESSION['message']) && $_SESSION['message'] != '') { ?>
   <div class="alert alert-success center-block" style="width: 80%;" role="alert">
    <p class="text-center"><strong>Success!</strong> 
      <?php echo $_SESSION['message']; $_SESSION['message'] = ''; ?>
    </p>
  </div>
<?php } ?>

<!-- Here shows all the recipe from fetch.php page using ajax call -->
   <span id="business_list"></span>
   <br />
   <br />
  </div>


  <div class="container">
  <div class="row">
        <div class="span12">
        <div class="thumbnail center well well-small text-center">
                <h2>Newsletter</h2>
                
                <p>Interested in getting similar smoothie recommedation?? 
                  <br>Enter your email to start getting recommendations.</p>
                
                <form action="sendEmail.php" method="post" autocomplete="off">
                    <div class="input-prepend form-group">

                      
                      <style="color: red; font-weight: bold;">
		      <input type="text" name="user_id" value="<?php echo  $userid;?>" />

                      
                      <input style="margin: 0px auto; width: 30% !important;" type="email" id="" class="form-control" name="email" required="" placeholder="your@email.com">
                    </div>
                    <br />
                    <button type="submit" class="btn btn-success" name="send" class="btn btn-large">Send Now!</button>
              </form>
            </div>    
        </div>
  </div>
</div>


 </body>
</html>

<script>
$(document).ready(function(){
 
 load_business_data();
 
 function load_business_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#business_list').html(data);
   }
  });
 }
 
 $(document).on('mouseenter', '.rating', function(){
  var user_id = $("#user_id").val();
  var index = $(this).data("index");
  var recipe_id = $(this).data('recipe_id');
  remove_background(recipe_id);
  for(var count = 1; count<=index; count++)
  {
   $('#'+recipe_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 function remove_background(recipe_id)
 {
  for(var count = 1; count <= 5; count++)
  {
   $('#'+recipe_id+'-'+count).css('color', '#ccc');
  }
 }
 
 $(document).on('mouseleave', '.rating', function(){
  var index = $(this).data("index");
  var recipe_id = $(this).data('recipe_id');
  var rating = $(this).data("rating");
  remove_background(recipe_id);
  //alert(rating);
  for(var count = 1; count<=rating; count++)
  {
   $('#'+recipe_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 $(document).on('click', '.rating', function(){
  var user_id = $("#user_id").val();
  var index = $(this).data("index");
  var recipe_id = $(this).data('recipe_id');
  $.ajax({
   url:"insert_rating.php",
   method:"POST",
   data:{index:index, recipe_id:recipe_id, user_id:user_id},
   success:function(data)
   {
    if(data == 'done')
    {
     load_business_data();
     alert("You have rate "+index +" out of 5");
    } 
    else if(data == 'already')
    {
     load_business_data();
     alert("You have already rated this recipe!");
    }
    else
    {
     alert("There is some problem in System");
    }
   }
  });
  
 });

});
</script>


