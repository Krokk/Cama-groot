<?php
	session_start();

	if (isset($_SESSION[LOGGED_ON]))
	{
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta charset="utf-8">
		<title>
		</title>
	</head>
	<body>
		<div class="header">
			<a href="index.php"><button class="title" name="button">CAMAGRU</button><a/>
 			<?php
 			if (isset($_SESSION[LOGGED_ON]))
 			{
				echo '<a href="gallery.php"><button class="icon" type="button" name="Gallery"><img src="./ressources/icons/galleryicon.png" style="width:4.5vw;height:4vw;"</img></button></a>';
				echo '<a href="logout.php"><button class="icon" type="button" name="Login"><img src="./ressources/icons/logout.png" style="width:4.5vw;height:4vw;"</img></button></a>';
 			}
 			else
 			{
				echo '<a href="sign_in.php"><button class="icon" type="button" name="Login"><img src="./ressources/icons/logins.png" style="width:4.5vw;height:4vw;"</img></button></a>';
				echo '<a href="sign_up.php"><button class="icon" type="button" name="Sign up"><img src="./ressources/icons/registericon.png" style="width:4.5vw;height:4vw;"</img></button></a>';
				echo '<a href="gallery.php"><button class="icon" type="button" name="Gallery"><img src="./ressources/icons/galleryicon.png" style="width:4.5vw;height:4vw;"</img></button></a>';
 			}
 			?>
		</div>
		<div id="headerusr" style="margin-top:2vw;">Hello <?php echo $_SESSION[LOGGED_ON]; ?></div>
		<div class="settings">
			<form class="" action="modifusername.php" method="post">
				<input type="text" name="newname" value="" placeholder="New username" style="width:150px;height:1vw;border-radius:0.5vw;">
				<input type="submit" name="submit" value="change username" style="height:2vw;width:120px">
			</form>
			<form class="" action="modifemail.php" method="post">
				<input type="text" name="newname" value="" placeholder="New email" style="width:150px;height:1vw;border-radius:0.5vw;">
				<input type="submit" name="submit" value="change email" style="height:2vw;width:120px">
			</form>
			<form class="" action="index.html" method="post">
				<br>
				<button type="button" style="width:150px:height:20px;" name="I don't want to receive emails when my photos are commented anymore"></button>
			</form>
		</div>
		<div class="footer">

		</div>

	</body>
</html>


<?php
}
?>
