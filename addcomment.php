<?php
	session_start();

	if ($_SESSION[LOGGED_ON])
	{
		$pic = $_POST[pic];
		echo "ok";
		try{
			$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$req = $conn->prepare("SELECT PhotoID, username FROM photos  where url = :url");
			$req->execute(array(
				':url' => $_POST[pic]
			));
			$idphoto = $req->fetch();
		}
		catch(PDOException $e)
		{
			echo "Couldn't write in Database: " . $e->getMessage();
		}
		
		try{
			$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$req = $conn->prepare('SELECT email FROM users  where username = :username');
			$req->execute(array(
				':username' => $idphoto[username]
			));
			$mailadress = $req->fetch();
		}
		catch(PDOException $e)
		{
			echo "Couldn't write in Database: " . $e->getMessage();
		}
		try
		{
			$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$req = $conn->prepare('INSERT INTO comments (photoID, author, timet, text) VALUES (:photoID, :author , NOW(), :text)');
			$req->execute(array(
				':photoID' => $idphoto[PhotoID],
				':author' => $_SESSION[LOGGED_ON],
				':text' => $_POST[comment]
			));
		}
		catch(PDOException $e)
		{
			echo "Couldn't write in Database: " . $e->getMessage();
		}
		$to       =  $mailadress;
		$subject  = 'New comment on your picture';
		$message  = '

		Your picture has been commented,

		------------------------
		'.$_SESSION[LOGGED_ON].' : '.$_POST[comment].' 
		------------------------

		Click on this link to see more:
		http://localhost:8080/Camagru/comment.php?pic= '.$pic.'

		';

		$headers = 'From:noreply@camagru.com' . "\r\n";
		
		mail($to, $subject, $message, $headers);		
		header('refresh:0;url=comment.php?pic=' . $pic . '');

	}

 ?>
