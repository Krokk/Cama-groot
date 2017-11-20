<?php
session_start();

$pic = explode(" ", $_GET[pic]);
$path = "./pics/";
if ($_SESSION[LOGGED_ON] === $pic[0])
{
	$pic = implode(" ", $pic);
	unlink("$path" . "$pic");
	header("location:index.php");
}
else {
	echo "FAKOFF";
}
?>
