<?php

session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE); 
ini_set('display_errors' , 1);
include ("add.php");
$db = mysqli_connect ($hostname, $username, $password);

if (mysqli_connect_errno())
{          
    mysqli_connect_error();
    exit();
}
print "<br>Successfully connected to MySQL.";

$uname   = $_GET["uname"];
$pass   = $_GET["pass"];
$delay  = 4;

if (!authenticate ($ucid, $pass, $db))
{ 
    echo "<br>Unable to add credentials.<br>";
    header ("refresh: $delay; url = welcome.html");
    exit () ;       
} 

    $_SESSION ["logged-in"]  = true;
    $_SESSION ["ucid"]       = $ucid;
    echo "<br>Being redirected to protected welcome page.<br>";
    header("refresh: $delay; url = welcome.html");
    exit ( );

?>