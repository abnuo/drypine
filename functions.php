<?php
$servername = "localhost";
$username = "root";
$password = "";
/*	     *
 * Functions *
 *	     */
$conn = new mysqli($servername, $username, $password,"userinfo");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$actconn = new mysqli($servername, $username, $password,"activity");
if ($actconn->connect_error) {
  die("Connection failed: " . $actconn->connect_error);
}
function queryMysql($query)
  {
    global $conn;
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    return $result;
}

function readcookie($cookie)
{
	if (isset($_COOKIE[$cookie])){
		return $_COOKIE[$cookie];
	}
}
function createsession($user,$token)
{
	setcookie("sesh",$user,time() + (86400 * 15));
	setcookie("token",$token,time() + (86400 * 15));
	$_COOKIE['sesh'] = $user;
	$_COOKIE['token'] = $token;
}
function checksession()
{
	$username = readcookie('sesh');
	$realPassQuery = queryMysql("SELECT pass FROM users WHERE username = '" . $username . "'");
	$realPass = $realPassQuery->fetch_array()[0] ?? '';
	if((!isset($_COOKIE['sesh'])) or (readcookie('token') != $realPass)) {
		return False;
	}
	else {
		return True;
	}
}
function destroysession(){
	if (checksession()){
		setcookie("sesh", "", time() - 3600);
		setcookie("token", "", time() - 3600);
	}
}
function isValid($str) {
    return !preg_match('/[^A-Za-z0-9.#\\-$]/', $str);
}
function newActivity($activity)
  {
    global $actconn;
    $result = $actconn->query("INSERT INTO activity VALUES('" . $activity . "')");
    if (!$result) die($actconn->error);
    exec("/opt/local/bin/curl -X POST -H \"Content-Type: application/json\" -d '{\"username\": \"DryPineyBoi\", \"content\": \"$activity\"}' \"https://canary.discord.com/api/webhooks/822458943287590922/Oxvs1Ov6Vme70ff7NYu5a69JubJnPNduGEwxUGr76rfFJlBhLVdOjDmcFE5Aqw0_ROfD\"");
    return $result;

}
function listActivity($amount)
{
    $activity = array();
    global $actconn;
    $result = $actconn->query("SELECT activity FROM activity");
    if (!$result) die($actconn->error);
    if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    array_push($activity,$row['activity'] . "<br>" . "<hr>" . "<br>");
  }
  $activity = array_reverse($activity);
  echo implode($activity);
    } 
}
function users()
{
    global $conn;
    $result = $conn->query("SELECT username FROM users");
    if (!$result) die($conn->error);
    if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	  echo " <a href = '/users/" . $row['username'] . ".php'> " . $row['username'] . "</a>";
  }
    } 
}
function getbio($user)
{
	global $conn;
	$result = $conn->query("SELECT bio FROM users WHERE username ='" . $user . "';"); 
	if (!$result) die($conn->error);
	if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	  echo html_entity_decode($row['bio']);
  }
    } 

}
function getbbio($user)
{
	global $conn;
	$result = $conn->query("SELECT bbcode_bio FROM users WHERE username ='" . $user . "';"); 
	if (!$result) die($conn->error);
	if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	  echo html_entity_decode($row['bbcode_bio']);
  }
    } 

}
function getAvatar($user){
	global $conn;
	$result = $conn->query("SELECT avatar FROM users WHERE username ='" . $user . "';"); 
	if (!$result) die($conn->error);
	if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	  return $row['avatar'];
  }
	} 
}
function everything_in_tags($string, $tagname)
{
    $pattern = "#<\s*?$tagname\b[^>]*>(.*?)</$tagname\b[^>]*>#s";
    preg_match($pattern, $string, $matches);
    return $matches[1] ?? null;
}

function loadcomments()
{
	if (isset($_COOKIE['sesh']) && (readcookie('sesh') == basename($_SERVER['PHP_SELF'],'.php'))) {
	echo "<a href='../changebio.php'>Change bio</a> <br> <a href='../changeava.html'>Change avatar</a>";
	}
	if (isset($_COOKIE['sesh']))
	{
	echo "<h3>Comments</h3><form action='/postcomment.php' method='post'> <textarea id='comment' name='comment' rows='4' cols='50'> </textarea> <br><br> <input type='submit' value='Post'> </form><hr>";
	}
	else {
	echo "<br><br>";
	}
	$row = 1;
if (($handle = fopen("/Users/queddd/Sites/users/" . basename($_SERVER['PHP_SELF'],'.php') . '.csv', "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
		if($c % 2 == 0){
			$user = everything_in_tags($data[$c],"a");
			if ($user != ""){
				echo "<img src='" . getAvatar($user) . "' width='40' height='40'></img> " . $data[$c];
			}
    	}
	else{
		 echo $data[$c] . "</br> <hr>";
    	}
           
        }
    }
    fclose($handle);
}
}
function allowlist($thing){
	if ($thing == "sb3"){
		return ".sb3";
	} elseif ($thing == "image")  {
		return ".png, .gif, .jpg";
	}
	elseif ($thing == "tracker"){
		return ".mod, .s3m, .it, .mptm";
	
	} elseif ($thing == "audio") {
		return ".wav, .mp3, .ogg";
	}
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
