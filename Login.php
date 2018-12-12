<style>
			html body {
					margin: 0;
					padding: 0;
				}
			h1 { 
				text-align: center;
				text-decoration: underline;
			}
			h2 {
				background-color: #00aeff; 
				padding: 10px;
			}
			h3{
				text-decoration: underline;
			}
			body{
				font-family: Arial Helvetica, sans-serif;
				color: white;
				background-color: #24478f;
			}
			.topnav {
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #173048;
			}

			.topnav a {
			  float: right;
			  color: #f2f2f2;
			  text-align: center;
			  padding: 14px 16px;
			  text-decoration: none;
			  font-size: 17px;
			}

			.topnav aside {
				float: left;
				color: #f2f2f2;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
				font-size: 17px;
			}

			.topnav a:hover {
			  background-color: #ddd;
			  color: black;
			}

			.topnav a.active {
			  background-color: #21b0f1;
			  color: white;
			}
</style>
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
			header("location: index.php");
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

echo "<div class=\"topnav\">";
echo "<a href=\"PicrossReg.php\">Register</a>";
echo "</div>";
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