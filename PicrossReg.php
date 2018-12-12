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
		$age = $mysqli->real_escape_string($_POST['age']);
		$gender = $mysqli->real_escape_string($_POST['gender']);
		$location = $mysqli->real_escape_string($_POST['location']);
		$password = md5($_POST['password']);
		$avatar_path = $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);
		
		if(preg_match("!image!", $_FILES['avatar']['type'])){
			
			if(copy($_FILES['avatar']['tmp_name'], $avatar_path)){
				
				$_SESSION['username'] = $username;
				$_SESSION['avatar'] = $avatar_path;
				
				$sql = "INSERT INTO Players (username, firstname, lastname, email, age, gender, location, password, avatar) "
						. "VALUES ('$username', $firstname, $lastname, '$email', $age, $gender, $location, '$password', '$avatar_path')";
						
				if($mysqli->query($sql) === true){
					$_SESSION['message'] = "Registration Successful! $username is added to the database!";
					$_SESSION['user_name'] = $username;
					header("location: picros.php");
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
	  <div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required /></div><br>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

<!--		$firstname = $mysqli->real_escape_string($_POST['firstname']);
		$lastname = $mysqli->real_escape_string($_POST['lastname']);
		$age = $mysqli->real_escape_string($_POST['age']);
		$gender $mysqli->real_escape_string($_POST['gender']);
		$location $mysqli->real_escape_string($_POST['location']);<-->