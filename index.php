<?php 
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<title> WIP </title>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
			<div class="sidebar">
		<h1> recent activity </h1>
		<div class="extraInf">
<?php
listActivity(5);
?>
		</div>
	</div>
	<div>
		<p>
		<h1>site-test</h1>
		<h1>__________________________</h1>
		<div class="project"><img src="/avatars/bruhly.gif" class="projthumbnail"></img><br><br><a>Project name</a><br><a>By </a><a href="/users/user.php">user</a></div>
	</div>
		

</body>
</html> 
