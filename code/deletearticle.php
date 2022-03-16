<?php
echo $_SESSION['token'];
session_start();
$sessiontoken = $_SESSION['token'];
$localtoken=$_POST['localtoken']; 
echo "localtoken ".$localtoken;
echo "<br>";
echo $sessiontoken;
echo "aid".$_POST['aid'];
include("config.php");
include("lib/db.php");
#put the token here, if statement 
#send a form with the aid?
#i
if (isset($sessiontoken) && isset ($localtoken)){
    if($sessiontoken==$localtoken){
    $aid = $_POST['aid'];
    $result = delete_article($dbconn, $aid);
    }
}
    
    
    #header("Location: /admin.php");

#echo "aid=".$aid."<br>";

#echo "result=".$result."<br>";
# Check result
#h
?>
