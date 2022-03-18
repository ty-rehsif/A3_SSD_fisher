<?php include("templates/page_header.php");?>
<?php include("lib/auth.php") ?>
<!doctype html>
<html lang="en">
<head>
	<title>Admin</title>
	<?php include("templates/header.php"); ?>
</head>
<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>

<h2>Article Management</h2>
<!-- creating token, assigning to session and local variables -->
<?php 
#if the session isnt set or the session is not authenticated, unset the session values, destroy session and send to login page
if(!(isset($_SESSION['authenticated'])) && !($_SESSION['authenticated'])){
	session_unset();
	session_destroy();
	header("Location: /login.php");
  }
  else{
$_GET['token'] = (bin2hex(openssl_random_pseudo_bytes(32))); 
$localtoken = $_GET['token'];
$_SESSION['token'] = $localtoken;
  }
?>
<p><button type="button" class="btn btn-primary" aria-label="Left Align" onclick="window.location='/newarticle.php';">
New Post <span class="fa fa-plus" aria-hidden="true"></span>
</button></p>

<table class="table">
<tr><th>Post Title</th><th>Author</th><th>Date</th><th>Modify</th></tr>

<?php
# get articles by user or, if role is admin, all articles
		$result = student_get_article_list($dbconn);
		while ($row = pg_fetch_array($result)) {
	?>
<tr>
  <td><a href='article.php?aid=<?php echo $row['aid'] ?>'><?php echo $row['title'] ?></a></td>
  <td><?php echo $row['author'] ?></td>
  <td><?php echo substr($row['date'],0,10) ?></td>
  <td><a href="/editarticle.php?aid=<?php echo $row['aid'] ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
  </tr>
	<?php } //close while loop ?>
</table>
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>