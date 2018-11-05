<?PHP
require_once("./include/configuration.php");

if(!$registration->CheckLogin())
{
    $registration->RedirectToURL("login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Home page</title>
</head>
<body>
<div id='fg_membersite_content'>
<h2>Home Page</h2>
Welcome back <?= $registration->UserFullName(); ?>!

<p><a href='member-content.php'>A sample 'Members-Only' page</a></p>
<br><br><br>
<p><a href='logout.php'>Logout</a></p>
</div>
</body>
</html>
