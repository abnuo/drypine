<link rel="stylesheet" href="style.css">
<div>
<?php
include "functions.php";
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$result = queryMysql("SELECT * FROM users WHERE username='$username'");
if (!isValid($username) or (14 < strlen($username)) or ($result->num_rows))
{
	echo "<h1>The username $username is invalid!</h1> <br> <h5>Keep your username under 14 characters, and don't use special characters. Also, the username may already exist.</h5> <br> <a href='/register.php'>Click here to try again.</a>";
}
else {
	queryMysql("INSERT INTO users VALUES('$username', '$password','0','/avatars/noavatar.png','This user has no bio.','This user has no bio.')");
	$output = shell_exec('/usr/local/bin/python3 makeuserpage.py ' . $username . " n2~#xV3}P=ghfGQe 2>&1");
	exec('/usr/bin/touch users/' . $username . '.csv');
	//echo $output;
	newActivity($username . " just created their account!");
	createsession($username,$password);
	echo "<h1>Your account has been created.</h1> <a href='/index.php'> Click here to go back to the homepage. </a>";
}
?>
</div>
