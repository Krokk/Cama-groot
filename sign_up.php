<?php
	function checkuserindb($username)
	{
		$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "elefant1");
		
	}

	 if (isset($_POST[button]) && isset($_POST[username]) && isset($_POST[password]))
	 {
		$password = hash("whirlpool", $_POST[password]);
		$bdd = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "elefant1");
		$req = $bdd->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
		$req->execute(array(
			':username' => $_POST['username'],
			':password' => $password
		));
	}
 ?>

<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="header">
			<a href="index.html"><button class="title" name="button">CAMAGRU</button><a/>
		</div>
		<div class="mainreg">
			<form action="sign_up.php" method="post">
				<input required="true" class="login" type="text" placeholder="username" name="username">
				<br>
				<input required="true" class="password" type="password" placeholder="password" name="password">
				<button class="registerbutton" type="submit" name="button">Sign up</button>
			</form>
		</div>
		<div class="footer">

		</div>

	</body>
</html>
