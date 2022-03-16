<html>
<body>
<p>CSRF</p>
<?php
if (isset($_GET['aid'])){
    $aid = $_GET['aid'];
}
?>
<img src="deletearticle.php?aid=<?php echo $aid ?>" width="100" height="100">
<a href="/admin.php">go back</a>
</body>
</html>