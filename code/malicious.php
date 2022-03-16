<html>
<body>
<p>CSRF</p>
<?php
if (isset($_GET['aid'])){
    $aid = $_GET['aid'];
    $image_url = "deletearticle.php?aid=$aid";
}
?>
<img src="<?php echo $image_url;?>" width="100" height="100"> 
<a href="/admin.php">go back to admin</a>
</body>
</html>