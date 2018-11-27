<?php
ob_start();
require('connect.php');
if(isset($_GET['id']) && !empty($_GET['id'])){
	$selsql = "SELECT location FROM `files` WHERE id=" . $_GET['id'];
	$result = mysqli_query($connection, $selsql);
	$r = mysqli_fetch_assoc($result);
	if(unlink($r['location'])){
		$delsql="DELETE FROM `files` WHERE id=" . $_GET['id'];
		if(mysqli_query($connection, $delsql)){
			header("Location: view.php");
		}
	}
}else{
	header("Location: view.php");
}