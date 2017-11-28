<?php
	session_start();
	if (!isset($_SESSION[LOGGED_ON]))
		header('location:index.php');
	$pic = $_GET[pic];
?>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">

		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="header">
			<a href="index.php" style=""><button class="title" name="button">CAMAGRU</button><a/>
			<a href="gallery.php"><button class="icon" type="button" name="Gallery"><img src="./ressources/icons/galleryicon.png" style="width:4.5vw;height:4vw;"</img></button></a>
			<a href="logout.php"><button class="icon" type="button" name="Login"><img src="./ressources/icons/logout.png" style="width:4.5vw;height:4vw;"</img></button></a>
		</div>

		<div id="global">
			<div id="gauche">
				<?php
				echo '<img src="./pics/' . $pic . ' "alt="missing" style="height:24vw;width:34vw;margin-top:3vw;" />';
				echo '<form class="" action="addcomment.php" method="post">
					<input type="text" placeholder="Your comment here" name="comment" style="width:34vw;" required>
					<br>
					<input type="submit" value="submit">
				</form>';

				?>
			</div>
			<div id="droite">
				<form class="" action="index.html" method="post">

				</form>
			</div>
		</div>
			<div class="footer">

			</div>
	</body>
</html>
