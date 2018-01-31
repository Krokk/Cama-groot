<?php
	session_start();

	if (!isset($_SESSION['LOGGED_ON']))
		header('location:index.php');

		try
		{
			$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$update = $conn->prepare("SELECT * FROM users WHERE username = :username");
			$update->bindParam(':username', $_POST['newname']);
			$update->execute();
		}
		catch (Exception $e)
		{
			echo "Couldn't update : " . $e->getMessage();
		}
		if ($update->rowCount() == 0 && $_POST['newname'])
		{
			try
			{
				$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$update = $conn->prepare("UPDATE Photos SET username = :newusername WHERE username = :username");
				$update->execute(array(
					':newusername' => $_POST['newname'],
					':username' => $_SESSION['LOGGED_ON']
				));
			}
			catch (Exception $e)
			{
				echo "Couldn't update : " . $e->getMessage();
			}
			try
			{
				$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$update = $conn->prepare("UPDATE users SET username = :newusername WHERE username = :username");
				$update->execute(array(
					':newusername' => $_POST['newname'],
					':username' => $_SESSION['LOGGED_ON']
				));
			}
			catch (Exception $e)
			{
				echo "Couldn't update : " . $e->getMessage();
			}
			$_SESSION['LOGGED_ON'] = $_POST['newname'];
			header('location:user.php');
		}
		else {
			echo "Ce Login est deja utiliser.";
			header('refresh:1;url=location:user.php');
		}



 ?>
