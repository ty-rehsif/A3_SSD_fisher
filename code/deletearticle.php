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
    #query db for aid to find author
    $query = "SELECT author from articles where aid='".$aid."'";
    $result = run_query($dbconn, $query);
    $row = pg_fetch_array($result,0);
    $value = $row[0];
    if($result){
        #use author value from row to check role
        $query = "SELECT role from authors where id='".$value."'";
        $result = run_query($dbconn, $query);
        #if rseult is found
        if ($result){
            $row = pg_fetch_array($result,0);
            $value = $row[0];
            #if value is admin
            if($value=="admin"){
              $result = delete_article($dbconn, $aid);  
              echo "result = ".$result;
            }
        }
    }
    #using author number find the role
    #if role is admin user can delete 
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