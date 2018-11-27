<?php
$connection = mysqli_connect('capstonedb.cmste82q8owq.us-east-1.rds.amazonaws.com', 'thares96', 'Guitars6', 'projectdb');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'projectdb');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>