<?php
#echo "this page is loading, fingers crossed";
#echo "the user name should be ".$_POST['username'];
session_start();

$username = "";
$email    = "";
$errors = array(); 

echo count($errors);
$db = mysqli_connect('capstonedb.cmste82q8owq.us-east-1.rds.amazonaws.com', 'thares96', 'Guitars6', 'projectdb');

if (isset($_POST['username'])) {
  #echo "testing - we made it inside our main conditional block, yay!";
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $pass = mysqli_real_escape_string($db, $_POST['pass']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  #$username = $_POST['username'];
  #$pass     = $_POST['pass'];
  #$email    = $_POST['email'];
	#echo "**** testing key values ****".$username.$pass.$email."****";
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($pass)) { array_push($errors, "Password is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
 #echo "made it past error checking";
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
 // echo "hello world - manual debugging statement here - low tech but works";
  if (count($errors) == 0) {
  	$pass = md5($pass);
  	$query = "INSERT INTO projectdb.users (username, pass, email) 
  			  VALUES('$username', '$pass', '$email')";
	#echo $query;
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
	#echo "should be in redirect block if statement";
  	$pass = md5($pass);
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
