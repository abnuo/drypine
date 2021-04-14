<link rel="stylesheet" href="style.css">
<?php
require_once 'header.php';
if (!checksession()){
	echo "You need to login first!";
} else {
	echo file_get_contents("makeproject.html");
}

?>

