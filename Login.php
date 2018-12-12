<?php
//Config file
require_once 'config_mysql.php';
session_start();
$_SESSION['message'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	if(!empty($_POST['password']) && !empty($_POST['username'])){
		
		$username = $mysqli->real_escape_string($_POST['username']);
		$email = $mysqli->real_escape_string($_POST['username']);
		$password = md5($_POST['password']);
	
		$sql = "SELECT * FROM Players WHERE password = '$password' AND (username = '$username' OR email = '$email')";
		$results = $mysqli->query($sql);
		if($results->num_rows == 1){
			$user = $results->fetch_assoc();
			$_SESSION['message'] = "Login successful!";
			$_SESSION['user_name'] = $user['username'];
			$_SESSION['player_id'] = $user['id'];
			$_SESSION['avatar'] = $user['avatar'];
			header("location: picros.php");
			die();
		}
		else{
			$_SESSION['message'] = "Information incorrect";
		}
	}
	else {
		$_SESSION['message'] = "Please enter your username and password.";
	}
}
?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="PicrossStyle.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Login</h1>
    <form class="form" action="Login.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="User Name or Email" name="username" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="submit" value="Login" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>