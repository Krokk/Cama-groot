<?php
session_start();
session_destroy();
header( "location:index.php" );
?>
<!-- <html>
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
			echo '<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>';
			echo '<a href="sign_up.php"><button class="button" type="button" name="Sign up"> Register</button></a>';
			?>
		</div>
	</div>
	<div class="main">
	<div class="error_message" style ="text-align:center;"> Logged out successfully. </br></br>
	You will be redirected to the <a href="index.php"><type="text" class="" name="button">Homepage<a/> in 5 sec ...  </div>
	</div></br>

	<div class="footer">

	</div>
	</body>
</html> -->
