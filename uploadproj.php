<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<?php include_once 'header.php';?>
<head>
    <meta charset="UTF-8">
    <title>Upload project</title>
</head>
<body>
<div>
    <form action="createproj.php" method="post" enctype="multipart/form-data">
	Upload a file of any these formats: <?php echo "'" . allowlist(implode($_POST)) . "' <br>"; ?>
	<input type="file" name="the_file" id="fileToUpload" accept=<?php echo "'" . allowlist(implode($_POST)) . "'"; ?>>
	<input type="submit" name="submit" value="Upload file" >
    </form>
</div>
</body>
</html>
