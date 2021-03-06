<?php
require('connect.php');
 
$sql = "SELECT * FROM `files`";
$result = mysqli_query($connection, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>View AChording.ly</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    
<link rel="stylesheet" href="style.css" >
 
<!-- JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function deleteItem(id) {
    if (confirm("Are you sure?")) {
        // your deletion code
        window.location.href='delete.php?file_ID=';
    }
    return false;
}
</script>
 
</head>
<body>
 
<nav> 
    <a href="index.php">Home</a> &nbsp;
    <a href="upload.php">Upload</a> &nbsp;
    <a href="view.php">View</a> &nbsp;
    <a href="login.php">Logout</a> &nbsp;
</nav>

<div class="container">
 
<table class="table">
  <thead>
    <tr>
      <th>File ID</th>
      <th>Name</th>
      <th>Size</th>
      <th>Type</th>
      <th>View</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
  	while($r = mysqli_fetch_assoc($result)){
   ?>
    <tr>
      <th scope="row"><?php echo $r['file_ID'] ?></th>
      <td><?php echo $r['name'] ?></td>
      <td><?php echo $r['size'] ?></td>
      <td><?php echo $r['type'] ?></td>
      <td><a href="<?php echo $r['location'] ?>">View</a></td>
      <td><a href=delete.php?file_ID=<?php echo $r['file_ID'];?> onclick= deleteItem(<?php echo $r['file_ID'] ?>)>Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>   
</div>
</body>
</html>