<!DOCTYPE html>
<html>
    <nav> 
    <a href="index.php">Home</a> &nbsp;
    <a href="drag.php">Upload/Download</a> &nbsp;
    <a href="email.php">Email Files</a> &nbsp;
    <a href="login.php">Logout</a> &nbsp;
</nav>
<form enctype="multipart/form-data" method="POST" action=""> 
	<label>Your Name <input type="text" name="sender_name" /> </label> 
	<label>Your Email <input type="email" name="sender_email" /> </label> 
	<label>Subject <input type="text" name="subject" /> </label> 
	<label>Message <textarea name="message"></textarea> </label> 
	<label>Attachment <input type="file" name="attachment" /></label> 
	<label><input type="submit" name="button" value="Submit" /></label> 
</form> 
</html>

<?php
if($_POST['button'] && isset($_FILES['attachment'])) 
{ 

	$from_email		 = 'sender@abc.com'; //from mail, sender email addrress 
	$recipient = 'recipient@xyz.com'; //recipient email addrress 
	
	//Load POST data from HTML form 
	$sender_name = $_POST["sender_name"] //sender name 
	$reply_to_email = $_POST["sender_email"] //sender email, it will be used in "reply-to" header 
	$subject = $_POST["subject"] //subject for the email 
	$message = $_POST["message"] //body of the email 
		
	//Get uploaded file data using $_FILES array 
	$tmp_name = $_FILES['my_file']['tmp_name']; 
	$name	 = $_FILES['my_file']['name']; 
	$size	 = $_FILES['my_file']['size'];  
	$type	 = $_FILES['my_file']['type']; 
	$error	 = $_FILES['my_file']['error']; 

	//validate form field for attaching the file 
	if($file_error > 0) 
	{ 
		die('Upload error or No files uploaded'); 
	} 

	$handle = fopen($tmp_name, "r"); 
	$content = fread($handle, $size);
	fclose($handle);				

	$encoded_content = chunk_split(base64_encode($content)); 

	$boundary = md5("random"); // define boundary with a md5 hashed value 

	//header 
	$headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version 
	$headers .= "From:".$from_email."\r\n"; // Sender Email 
	$headers .= "Reply-To: ".$reply_to_email."\r\n"; // Email addrress to reach back 
	$headers .= "Content-Type: multipart/mixed;\r\n"; // Defining Content-Type 
	$headers .= "boundary = $boundary\r\n"; //Defining the Boundary 
		 
	$body = "--$boundary\r\n"; 
	$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n"; 
	$body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
	$body .= chunk_split(base64_encode($message)); 
		
	$body .= "--$boundary\r\n"; 
	$body .="Content-Type: $file_type; name=".$file_name."\r\n"; 
	$body .="Content-Disposition: attachment; filename=".$file_name."\r\n"; 
	$body .="Content-Transfer-Encoding: base64\r\n"; 
	$body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n"; 
	$body .= $encoded_content; // Attaching the encoded file with email 
	
	$sentMailResult = mail($recipient, $subject, $body, $headers); 

	if($sentMailResult ) 
	{ 
	echo "File Sent Successfully."; 
	unlink($name); 
	} 
	else
	{ 
	die("Sorry but the email could not be sent. 
					Please go back and try again!"); 
	} 
} 
