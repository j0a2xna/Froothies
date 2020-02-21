<?php
function get($fieldname)
{ 
    global $db;
    if(!isset($_GET [$fieldname]) || $_GET [$fieldname] == " ")
    {
        echo "<br>The value of $fieldname is either NULL or empty."; 
        $v = NULL;
        return $v; 
    } 
    $v = $_GET[$fieldname];   
    $v = trim ($v);
    $v=mysqli_real_escape_string($db,$v);
    echo "<br>The value of $fieldname is $v.";
    if(isset($box))
    {
        echo "box is defined.";
    }
    return $v;   
}

function authenticate ($uname, $pass, $db)
{
    {$s = "select * from USERS where uname='$uname' and password='$pass' "; }
    print "<br>SQL credentials select statement is : $s" ;
    ($t = mysqli_query ($db, $s)) or die(mysqli_error($db));
    
    $num = mysqli_num_rows($t);
    if ($num == 0)
        { return false; }
    else
        { return true; }  
    $hash = $r['hash'];

    if ( password_verify ($pass, $hash) )
        { return true; }
    else
        { return false; }
}
function display ($ucid,$account,$box,$number,&$result,$db)
{
#Accounts :
    print "<br>Accounts follow :<br>";
    if(isset($box))
    { 
        $s1 = "select * from accounts where ucid='$ucid' ";
    }
    if(!isset($box))
    { 
        $s1 = "select * from accounts where ucid='$ucid' and account= '$account' "; 
    }
    echo "<br>SQL statement is: $s1<br><br>";
    ($t = mysqli_query ($db,$s1)) or die(mysqli_error());
    
    $num = mysqli_num_rows($t);
    print "$num rows retrieved from accounts.<br>";
    
    while ($row = mysqli_fetch_array($t, MYSQLI_ASSOC))
    {
        $account = $row["account"];
        $balance = $row["balance"];
        print "<br> account: $account || balance: $balance";
    }
    print "<br><hr align = left width = 1000><br>" ;
#Tansaction :
   print "<br>Transaction follow.";
    if(isset($box))
    {
        $s = "select * from TRANSECTION where ucid='$ucid' ";
    }
    if(!isset ($box))
    {
        $s = "select * from TRANSECTION where ucid='$ucid' and account= '$account' ";
    }
    ($t = mysqli_query ($db, $s)) or die(mysqli_error($db));
    
    $num = mysqli_num_rows($t);
print "<br>$num rows retrieved from transection.<br>";
    
    while ($row = mysqli_fetch_array($t, MYSQLI_ASSOC))
    {
        $account = $row["account"];
        $amount = $row["amount"];
        $timestamp = $row["timestamp"];
        print "<br> account: $account || amount: $amount || timestamp: $timestamp " ;
    }
    print "<br><hr align = left width = 1000><br>" ;
}

function transact ($ucid,$account,$amount,$box,$number,&$result,$db)
{
    $s1 = "select * from accounts where ucid = '$ucid' and account = '$account' and balance + '$amount' >= 0.00";
    print "SQL overdraft statement is: $s1<br><br>";
        ($t = mysqli_query ($db, $s1)) or die(mysqli_error($db));
    
        $num = mysqli_num_rows($t);
        if( $num == 0 )
        {
            print "<br>Either invalid account or overdraft blocked."; 
            return $s1;
        }
#1 insert transact
    $s1= "insert into TRANSECTION values ('$ucid','$account','$amount',NOW(),'N' )";
        print "SQL insert statement is: $s1";
        
    ($t=mysqli_query($db,$s1)) or die(mysqli_error($db));
#2 update
    $s1="update accounts set recent =NOW(), balance='$amount' +balance where ucid='$ucid' and account='$account'";
        print "<br>SQL update accounts statement is: $s1<br>";
    ($t=mysqli_query($db,$s1)) or die(mysqli_error($db));

    display ($ucid,$account,NULL,$number,$result2,$db);
    $result=$result2;
}
?>