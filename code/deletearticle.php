<?php
session_start();
include("config.php");
include("lib/db.php");
#put the token here, if statement 
$sessiontoken = $_SESSION['token'];
$localtoken=$_POST['localtoken'];
if (isset($sessiontoken) && isset ($localtoken)){
    if($sessiontoken==$localtoken){
    $aid = $_POST['aid'];
    $result = delete_article($dbconn, $aid);
    }
}
header("Location: /admin.php");
#echo "aid=".$aid."<br>";
#echo "result=".$result."<br>";
# Check result
?>

<html>
    <br>
    <a href="/admin.php">Back to admin page</a>
</html>