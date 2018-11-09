<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('capstonedb.cmste82q8owq.us-east-1.rds.amazonaws.com', 'thares96', 'Guitars6', 'Capstone_DB');

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $pass_1 = mysqli_real_escape_string($db, $_POST['pass_1']);
  $pass_2 = mysqli_real_escape_string($db, $_POST['pass_2']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($pass_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $pass_2) { array_push($errors, "The two passwords do not match"); }
  if (empty($email)) { array_push($errors, "Email is required"); }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  if (count($errors) == 0) {
  	$pass = md5($pass_1);
  	$query = "INSERT INTO users (username, password, email) 
  			  VALUES('$username', '$pass', '$email')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($pass)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND pass='$pass'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}
}
?>
