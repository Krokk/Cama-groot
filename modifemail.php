<?php
session_start();
if (!isset($_SESSION['LOGGED_ON']))
{
	header('location:index.php');
	echo "Please update email in your settings page";
}
else
{
	try
	{
		$conn = new PDO("mysql:host=127.0.0.1;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$update = $conn->prepare("SELECT * FROM users WHERE email = :newmail");
		$update->bindParam(':newmail', $_POST['newmail']);
		$update->execute();
	}
	catch (Exception $e)
	{
		echo "Couldn't update : " . $e->getMessage();
	}
	if ($update->rowCount() == 0 && $_POST['newmail'])
	{
		if (filter_var($email = $_POST['newmail'], FILTER_VALIDATE_EMAIL))
		{
			try
			{
				$conn = new PDO("mysql:host=127.0.0.1;dbname=db_camagru", "root", "root");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$update = $conn->prepare("UPDATE users SET email = :newmail WHERE username = :username");
				$update->execute(array(
					':newmail' => $_POST['newmail'],
					':username' => $_SESSION['LOGGED_ON']
				));
			}
			catch (Exception $e)
			{
				echo "Couldn't update : " . $e->getMessage();
			}
			header('location:user.php');
		}
		else
		{
			header( "refresh:2;url=user.php" );
			echo "incorrect email format";
		}
	}
	else
	{
		header( "refresh:2;url=user.php" );
		echo "email is already used";
	}
}
?>

 <!DOCTYPE html>
 <html>
	<head>
		<meta charset="utf-8">
		<link rel="icon" type="image/png" href="./ressources/icons/favicon.png" />
		<title></title>
	</head>
	<body>

	</body>
 </html>
