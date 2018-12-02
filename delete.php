<?php
ob_start();
require('connect.php');
if(isset($_GET['file_ID']) && !empty($_GET['file_ID'])){
	$selsql = "SELECT location FROM files WHERE file_ID=" .$_GET['file_ID'];
	$result = mysqli_query($connection, $selsql);
	$r = mysqli_fetch_assoc($result);
	if($r['location']) {
		$delsql="DELETE FROM files WHERE file_ID=" .$_GET['file_ID'];
		if(mysqli_query($connection, $delsql)){
			header("Location: view.php");
		}
	}
} else{
	header("Location: view.php");
}
?>
