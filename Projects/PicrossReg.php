<?php
//Config file
require_once 'config_mysql.php';
session_start();
$_SESSION['message'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	if($_POST['password'] == $_POST['confirmpassword']){
		
		$username = $mysqli->real_escape_string($_POST['username']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$password = md5($_POST['password']);
		
		$_SESSION['username'] = $username;
	
		$sql = "INSERT INTO users (username, email, password) "
				. "VALUES ('$username', '$email', '$password')";
	
		if($mysqli->query($sql) === true){
			$_SESSION['message'] = "Registration Successful! $username is added to the database!";
			$_SESSION['user_name'] = $username;
			header("location: picros.php");
			die();
		}
		else{
			$_SESSION['message'] = "User name or email.";
		}
	}
	else {
		$_SESSION['message'] = "Your confirmed password did NOT match with your initial password.";
	}
}
?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="PicrossStyle.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form class="form" action="PicrossReg.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="User Name" name="username" required />
      <input type="email" placeholder="Email" name="email" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>