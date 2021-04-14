<link rel="stylesheet" href="style.css">
<div>
<?php
include "functions.php";
$username = $_POST['username'];
$password = $_POST['password'];
$realPassQuery = queryMysql("SELECT pass FROM users WHERE username = '" . $username . "'");
$realPass = $realPassQuery->fetch_array()[0] ?? '';
if(!password_verify($password,$realPass))
{
	echo "<h1>Incorrect password!!</h1> <br> <a href='/login.php'> Try again? </a>";
}
else {
	newActivity($username . " just logged in.");
	createsession($username,$realPass);
	echo "<h1>Welcome!</h1>  <meta http-equiv='refresh' content='1; URL=/index.php'>";
}
?>
</div>
