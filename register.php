<?php include('server.php' ) ?>
<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
    <h2>Register</h2>
    </div>
    
    <form method="post" action="server.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
    <label>Username</label>    
        <input type="text" name="username">   
    </div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="pass">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="pass">
  	</div>
    <div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
    </form>
    </body>
</html>
