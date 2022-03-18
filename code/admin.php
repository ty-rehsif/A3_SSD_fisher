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
$_GET['token'] = (bin2hex(openssl_random_pseudo_bytes(32))); 
$localtoken = $_GET['token'];
$_SESSION['token'] = $localtoken;
?>
<p><button type="button" class="btn btn-primary" aria-label="Left Align" onclick="window.location='/newarticle.php';">
New Post <span class="fa fa-plus" aria-hidden="true"></span>
</button></p>

<table class="table">
<tr><th>Post Title</th><th>Author</th><th>Date</th><th>Modify</th><th>Delete</th></tr>

<?php
# get articles by user or, if role is admin, all articles
		$result = get_article_list($dbconn);
		while ($row = pg_fetch_array($result)) {
	?>
<tr>
  <td><a href='article.php?aid=<?php echo $row['aid'] ?>'><?php echo $row['title'] ?></a></td>
  <td><?php echo $row['author'] ?></td>
  <td><?php echo substr($row['date'],0,10) ?></td>
  <td><a href="/editarticle.php?aid=<?php echo $row['aid'] ?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a></td>
  <td>
	  <!-- replace link with form, included csrf token and row aid-->
	  <form method="POST" action="/deletearticle.php">
		  <input type="hidden" id="aid" name="aid" value="<?php echo $row['aid'];?>" >
		  <input type="hidden" id="localtoken" name="localtoken" value="<?php echo $localtoken;?>" >
		  <button type="submit" class="btn btn-success" name="submit" id="">
		  <i class="fa fa-times fa-2x" aria-hidden="true"></i>
		</button>
	  </form>
  </td>
</tr>
	<?php } //close while loop ?>
</table>
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>