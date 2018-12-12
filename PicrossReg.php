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
	
	if($_POST['password'] == $_POST['confirmpassword']){
		
		$username = $mysqli->real_escape_string($_POST['username']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$firstname = $mysqli->real_escape_string($_POST['firstname']);
		$lastname = $mysqli->real_escape_string($_POST['lastname']);
		$age = $_POST['age'];
		$gender = $mysqli->real_escape_string($_POST['gender']);
		$location = $mysqli->real_escape_string($_POST['location']);
		$password = md5($_POST['password']);
		$avatar_path = $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);
		
		if(preg_match("!image!", $_FILES['avatar']['type'])){
			
			if(copy($_FILES['avatar']['tmp_name'], $avatar_path)){
				
				$_SESSION['username'] = $username;
				$_SESSION['avatar'] = $avatar_path;
									
				$sql = "INSERT INTO Players (username, firstname, lastname, email, age, gender, location, password, avatar) "
						. "VALUES ('$username', '$firstname', '$lastname', '$email', $age, '$gender', '$location', '$password', '$avatar_path')";
						
				if($mysqli->query($sql) === true){
					$_SESSION['message'] = "Registration Successful! $username is added to the database!";
					$_SESSION['user_name'] = $username;
					header("location: index.php");
				}		
				else{
					$_SESSION['message'] = "User could not be added to the database.";
				}		
			}
			else{
				$_SESSION['message'] = "File upload failed.";
			}
		}
		else{
				$_SESSION['message'] = "Please only upload GIF JPG, or PNG images.";
			}
	}
	else {
		$_SESSION['message'] = "Your confirmed password did NOT match with your initial password.";
	}
}
echo "<div class=\"topnav\">";
echo "<a href=\"Login.php\">Login</a>";
echo "</div>";
?>

<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="PicrossStyle.css" type="text/css">
<div class="body-content">
  <div class="module">
    <h1>Create an account</h1>
    <form class="form" action="PicrossReg.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input type="text" placeholder="User Name" name="username" required />
      <input type="text" placeholder="First Name" name="firstname" required />
      <input type="text" placeholder="Last Name" name="lastname" required />
      <input type="email" placeholder="Email" name="email" required />
      <input type="text" placeholder="Location" name="location" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required /><br><br>
      Gender:
      <input type="radio" name="gender" value="F">Female
      <input type="radio" name="gender" value="M">Male
      <input type="number" name="age" min="0" max="120" value="" required /> Age
	  <br>
	  <br>
	  <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required /></div><br>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>
