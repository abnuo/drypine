<?php
include "functions.php";
include 'bbcode.php';
include 'tag.php';
$commentpage = basename($_SERVER['HTTP_REFERER'],'.php');
$commentpageurl = substr($_SERVER['HTTP_REFERER'],0,-4);
$comment = $_POST['comment'];
$bbcode = new ChrisKonnertz\BBCode\BBCode();
$comment = $bbcode->render($comment);
$username = readcookie('sesh');
$token = readcookie('token');
$realPassQuery = queryMysql("SELECT pass FROM users WHERE username = '" . $username . "'");
$realPass = $realPassQuery->fetch_array()[0] ?? '';
$comment = htmlentities($comment);
$comment = escapeshellarg($comment);
$comment = str_replace( array( '\'', '"',
    ',' , ';', '<', '>' ,'`'), ' ', $comment);
if (($token != $realPass) or ($comment == ""))
{
	echo "Error updating comments. Empty comments don't work!";
}
else 
{
	$output = shell_exec("/usr/local/bin/python3 addcomment.py " . $username . " " . $commentpage . " \"" . $comment . "\" 2>&1");
	//echo "/usr/local/bin/python3 addcomment.py " . $username . " " . $commentpage . " " . $comment . " 2>&1";
	newActivity($username . " just commented on " . $commentpage);
	echo "<h1>Posting comment...</h1><meta http-equiv='refresh' content='1; URL=" . $_SERVER['HTTP_REFERER'] . "'>";
}

?>
