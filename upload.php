<?php
require('connect.php');
if(isset($_FILES) && !empty($_FILES)){
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];
 
$tmp_name = $_FILES['file']['tmp_name'];
}
$extension = substr($name, strpos($name, '.') + 1);
 
$max_size = 500000;
if(isset($name) && !empty($name)){
	if(($extension == "pdf" || $extension == "pdf") && $type == "application/pdf" && $size<=$max_size){
		$location = "files/";
        
		if(move_uploaded_file($tmp_name, $location.$name)){
			$query = "INSERT INTO 'files' (name, size, type, location) VALUES ('$name', '$size', '$type', '$location$name')";
        		$result = mysqli_query($connection, $query);
			$smsg = "Uploaded Successfully.";	
		}else{
			$fmsg = "Failed to Upload File";
		}
	}else{
		$fmsg = "Only PDF Files";
	}
}else{
	$fmsg = "Please Select a File";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload AChording.ly</title>
	
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  
<link rel="stylesheet" href="style.css" >
 
<!-- JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
 
<nav> 
    <a href="index.php">Home</a> &nbsp;
    <a href="upload.php">Upload</a> &nbsp;
    <a href="view.php">View</a> &nbsp;
    <a href="login.php">Logout</a> &nbsp;
</nav>    
    
<div class="container">
<?php //echo $name; ?>
<?php //echo $size; ?>
<?php //echo $type; ?>
<?php //echo $tmp_name; ?>
      <form class="form-signin" action = "upload.php" method="POST" enctype="multipart/form-data">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>      
        <h2 class="form-signin-heading">Upload File</h2>
	  <div class="form-group">
	    <label for="exampleInputFile">File input</label>
	    <input type="file" name="file" id="exampleInputFile">
	    <p class="help-block">Upload PDF Files</p>
	  </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Upload</button>
      </form>
</div>
 
</body>
 
</html>