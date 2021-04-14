<link rel="stylesheet" href="style.css">
<?php
require_once 'header.php';
?>
<div>
<form action="/updatebio.php" method="post">
<textarea id="bio" name="bio" rows="4" cols="50">
<?php getbbio(readcookie('sesh')); ?>
  </textarea>
  <br><br>
  <input type="submit" value="Submit">
</form>
</div>
