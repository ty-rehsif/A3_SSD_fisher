<?php
session_start();
include("config.php");
include("lib/db.php");
#put the token here, if statement 

$aid = $_GET['aid'];
#echo "aid=".$aid."<br>";
$result = delete_article($dbconn, $aid);
#echo "result=".$result."<br>";
# Check result
header("Location: /admin.php");

?>
