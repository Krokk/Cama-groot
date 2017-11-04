<?php
session_start();
$_SESSION["message"] = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	try
	{
        $username = $_POST["username"];
		$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$req = $con->prepare("SELECT username FROM users WHERE username = :username");
		$req->execute(array(':username' => $username));
		if ($req->rowCount() > 0)
		{
            try
            {
                $result = $con->prepare("SELECT email FROM users WHERE username = " . "'" . $username . "'");
                $result->execute();
                $email = $result->fetch();			

            }
            catch (PDOexception $e)
            {
                echo "Error Database : " . $e->getMessage();
            }
            try
            {
                $conflink = md5( rand(0,1000) );
                $update = $con->prepare("UPDATE users SET resetpsw = '1' WHERE email = :email");
                $update->execute(array(
                    ':email' => $email
                ));
            }		
            catch(PDOexception $e)
            {
                echo "Error Database : " . $e->getMessage();
            }
            $to       =  $email[0];
            $subject  = 'Camagru | Reset your password';
            $message  = '

            This email has been sent automatically by Camagru to your request to recorver your password.

            ------------------------
            Username: '.$username.'
            ------------------------

            Please click this link to reset your account password:
            http://localhost:8080/Camagru/verifypsw.php?email='.$email.'&conflink='.$conflink.'

            ';
            $headers = 'From:noreply@camagru.com' . "\r\n";
            mail($to, $subject, $message, $headers);
			$_SESSION[login_success] = "Reset Email has been sent";
			header( "refresh:3;url=index.php" );
        }
		else
		{
			$_SESSION[login_err] = "Username doesn't exist";
		}
	}
	catch (PDOexception $e)
	{
		echo "Error Database : " . $e->getMessage();
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
		<form class="modal-content" action="resetpsw.php" method="post">
            <div style = "padding:14%">
                <div class="log_error"><?= $_SESSION[login_err] ?></div>
				<div class="log_succes"><?= $_SESSION[login_success] ?></div>
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter user name" name="username" required>
                <div class="clearfix" style="text-align: center;">
                    <button type="submit" class="signup" name="clickme" style= "margin-left: 2%">Reset Password</button>
                </div>
            </div>
        </form>
		</div>
		<div class="footer">

		</div>

	</body>
</html>
