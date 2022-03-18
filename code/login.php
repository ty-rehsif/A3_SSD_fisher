<?php include("templates/page_header.php");?>
<?php

#if form is submitted 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	#validate data
	$name = $pw = "";
  #if username or password fields are empty log eror no value 
	if ((empty($_POST['username'])) or (empty($_POST['password']))) {  
    	error_log("Error! You didn't enter the username or password.", 0); 
      exit;   
	  }else {   #if values exist filter them 
    	$name = $_POST['username'];
    	$pw = $_POST['password'];
      $name = test_input($name);
      $pw = test_input($pw);
	    }
  
  #authenticate user
	$result = authenticate_user($dbconn, $name, $pw);
  #if result is found 
  if ($result){
    if (pg_num_rows($result) == 1) {
      $_SESSION['username'] = $name;
      $_SESSION['authenticated'] = True;
      $_SESSION['id'] = pg_fetch_array($result)['id'];
      if($name == "admin"){
      //Redirect to admin area
      header('Location: /admin.php');
      }else{
        header('Location: /student.php');
      }
      }
  }else{ #if didnt find user
    $_SESSION['authenticated'] = False;
    #redirect to the login page
    header('Location: /login.php');
  }
}



?>
<!doctype html>
<html lang="en">
<head>
	<title>Login</title>
	<?php include("templates/header.php"); ?>
<style>

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}

.form-signin .form-control:focus {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
</head>

<body>
	<?php include("templates/nav.php"); ?>
	<?php include("templates/contentstart.php"); ?>
<form class="form-signin" action="#" method='POST'>
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus name='username'>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name='password'>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
<br>
	<?php include("templates/contentstop.php"); ?>
	<?php include("templates/footer.php"); ?>
</body>
</html>
