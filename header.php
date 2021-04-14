<?php
include 'functions.php';
$loggedin = False;
$loggedin = checksession();
echo "<div class='banner'><a href='/index.php'> Home </a> <br>";
if ($loggedin) echo "<a href = '/create.php'>Create</a> <br>  Hello, <a href='/users/" . $_COOKIE['sesh'] . ".php'>" . $_COOKIE['sesh'] . "</a> <br> <a href='/logout.php'>logout</a> <a href='/users.php'>All users </a><br> </div>";
else echo "<a href='/login.php'>login</a><br><a href='/register.php'>register</a></div>";
?>
