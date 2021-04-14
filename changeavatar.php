<link rel="stylesheet" href="style.css">
<?php
include_once 'header.php';
?>
<div>
<?php
function resizeImage($user,$ext){
	$image = "avatars/" . $user . "." . $ext;
	$image2 = "avatars/" . $user . "2." . $ext;
	exec("/opt/local/bin/ffmpeg -y -i $image -vf scale=250:250 $image2",$butt);
	echo "/opt/local/bin/ffmpeg -y -i $image -vf scale=250:250 $image2";
	exec("/bin/rm $image; /bin/mv $image2 $image",$boi);
	echo "/bin/rm $image; /bin/mv $image2 $image";
	echo implode($butt);
	echo implode($boi);
	
}
ini_set('upload_tmp_dir',"/Users/queddd/Sites/temp");
$username = readcookie('sesh');
$token = readcookie('token');
$realPassQuery = queryMysql("SELECT pass FROM users WHERE username = '" . $username . "'");
$realPass = $realPassQuery->fetch_array()[0] ?? '';
if (($token != $realPass))
{
	echo "Error changing avatar, check that you are authenticated properly.";
}
else 
{
	$avatar = $_POST['avatar'];
	$avatar = substr($avatar, 21);
	$avatar = base64_decode($avatar);
	$avatarfile = fopen("avatars/" . readcookie('sesh') . ".png", "w");
	fwrite($avatarfile, $avatar);
	fclose($avatarfile);
	$path = ("avatars/" . readcookie('sesh'));
	$mime = mime_content_type($path . '.png');
	if ($mime = "image/gif"){
		$avatarurlquery = "UPDATE users SET avatar = \" " . "/avatars/" . readcookie('sesh') . ".gif" . "\" WHERE username =\"" . $username ."\";";
		exec("/bin/mv '" . $path . ".png' '" . $path . ".gif'");
		queryMysql($avatarurlquery);
	}
	elseif ($mime = "image/jpeg"){
		$avatarurlquery = "UPDATE users SET avatar = \" " . "/avatars/" . readcookie('sesh') . ".jpg" . "\" WHERE username =\"" . $username ."\";";
		exec("/bin/mv '" . $path . ".png' '" . $path . ".jpg'");
		queryMysql($avatarurlquery);	
	}
	else{
		$avatarurlquery = "UPDATE users SET avatar = \" " . "/avatars/" . readcookie('sesh') . ".png" . "\" WHERE username =\"" . $username ."\";";
		queryMysql($avatarurlquery);	
	}
		
	echo "Avatar changed!";
	newActivity($username . " just updated their avatar.");


}


?>
</div>
