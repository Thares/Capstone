<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>AChording.ly Home</title>
    <!-- Bootstrap -->
<link rel="stylesheet" //href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<nav> 
    <a href="index.php">Home</a> &nbsp;
    <a href="upload.php">Upload</a> &nbsp;
    <a href="view.php">View</a> &nbsp;
    <a href="login.php">Logout</a> &nbsp;
</nav>
<body>

<div class="header">
	<h1 style = "background-color: a94442">Welcome to AChording.ly!</h1>
</div>
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <?php  if (isset($_SESSION['username'])) : ?>
    <h2>Welcome <?php echo $_SESSION['username']; ?>!</h2>
        <p>Welcome to AChording.ly! Your one stop shop for uploading PDF files
        to share with your friends. <br><br> Click on the <strong>Upload</strong> tab above to upload
        files to the website! <br><br> Click on the <strong>View</strong> tab to view files
        uploaded to AChording.ly. <br><br>Happy Chording! :)</p>
    	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>