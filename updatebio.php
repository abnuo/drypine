<link rel="stylesheet" href="style.css">
<?php
include_once 'header.php';
?>
<div>
<?php
include 'bbcode.php';
include 'tag.php';
$bio = $_POST['bio'];
$username = readcookie('sesh');
$token = readcookie('token');
$realPassQuery = queryMysql("SELECT pass FROM users WHERE username = '" . $username . "'");
$realPass = $realPassQuery->fetch_array()[0] ?? '';
if($token != $realPass)
{
	echo "Error updating bio.";
	
}
else 
{
	$bioupdatequery = "UPDATE users SET bbcode_bio = \" " . $bio . "\" WHERE username =\"" . $username ."\";";
	queryMysql($bioupdatequery);
	$bbcode = new ChrisKonnertz\BBCode\BBCode();
	$bio = $bbcode->render($bio);
	$bio = htmlentities($bio);
	$bioupdatequery = "UPDATE users SET bio = \" " . $bio . "\" WHERE username =\"" . $username ."\";";
	queryMysql($bioupdatequery);
	echo "Bio updated. <meta http-equiv='refresh' content='1; URL=/index.php'>";
	newActivity($username . " just updated their bio.");
}
?>
</div>
