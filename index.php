<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="header">
			<a href="index.php"><button class="title" name="button">CAMAGRU</button><a/>
			<div class="box1">
			<?php
			if (isset($_SESSION[LOGGED_ON]))
			{
				// echo "<div>Bonjour " . $_SESSION["users"] . "!</div>";
				echo '<a href="profile.php"><button class="signed" style="padding-left: 0px;type="button" name="profile">' . $_SESSION[LOGGED_ON] ."</button></a>";
				
				// mettre un bouton qui call logout
				// <button type="submit" class="signup" name="clickme" style= "margin-left: 2%";>Sign Up</button>
				echo '<a href="logout.php"><button class="button" type="button" name="Logout">Log out</button></a>';
			}
			else
			{
				echo '<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>';
				echo '<a href="sign_up.php"><button class="button" type="button" name="Sign up"> Register</button></a>';
			}
			?>
			</div>
		</div>
		<div class="main">
		
		</div>
		<div class="footer">
		</div>	
	</body>
</html>
