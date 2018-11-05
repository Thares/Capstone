<?PHP
require_once("./include/configuration.php");

if(!$registration->CheckLogin())
{
    $registration->RedirectToURL("login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Registered Member Page</title>
</head>
<body>
<div id='Registered Content'>
<h2>This is an Access Controlled Page</h2>
This page can be accessed after logging in only. 
<p>
Logged in as: <?= $registration->UserFullName() ?>
</p>
<p>
<a href='login-home.php'>Home</a>
</p>
</div>
</body>
</html>
