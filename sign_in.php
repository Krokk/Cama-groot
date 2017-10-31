<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	try
	{
		$password = hash("sha512", $_POST[password]);
		$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$req = $con->prepare("SELECT username FROM users WHERE username = :username AND password = :password AND activated = '1'");
		$req->execute(array(
			':username' => $_POST['username'],
			':password' => $password,
			));
		if ($req->rowCount() > 0)
		{
			$donnees = $req->fetch();			
			$_SESSION[success] = "You are looged on " .$_POST['username'];
			$_SESSION[LOGGED_ON] =	$_POST['username'];
			header( "refresh:3;url=index.php" );
		}
		else
		{
			$_SESSION[message] = "Username or password incorrect";
		}

	}
	catch (PDOexception $e)
	{
		echo "couldn't log you in : " . $e->getMessage();
	}
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
			<a href="index.php"><button class="title" name="button">CAMAGRU</button><a/>
			<div class="box1">
 			<?php
 			if (isset($_SESSION[LOGGED_ON]))
 			{
 				echo '<a href="profile.php"><button class="signed" style="padding-left: 0px;type="button" name="profile">' . $_SESSION[LOGGED_ON] ."</button></a>";
 				echo '<a href="logout.php"><button class="button" type="button" name="Logout">Log out</button></a>';
 			}
 			else
 			{
 				echo '<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>';
 				echo '<a href="sign_up.php"><button class="button" type="button" name="Sign up">Sign up</button></a>';
 			}
 			?>
 			</div>
		</div>
		<div class="main">
		<form class="modal-content" action="sign_in.php" method="post">
            <div style = "padding:14%">
                <div class="log_error"><?= $_SESSION["message"] ?></div>
				<div class="log_succes"><?= $_SESSION[success] ?></div>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter user name" name="username" required>
				
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <div class="clearfix" style="text-align: center;">
                    <a href="index.php"><button class="signup" type="button" name="Cancel">Cancel</button></a>
                    <button type="submit" class="signup" name="clickme" style= "margin-left: 2%";>Sign Up</button>
                </div>
            </div>
            </form>
		</div>
		<div class="footer">

		</div>

	</body>
</html>
