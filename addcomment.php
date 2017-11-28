<?php
	session_start();
	
	if ($_SESSION[LOGGED_ON])
	{
		try{
			$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$req = $conn->prepare("SELECT PhotoID FROM photos where url = :url");
			$req->execute(array(
				':url' => $_POST[pic]
			));
			$idphoto = $req->fetch(PDO::FETCH_COLUMN, 0);    
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
				':photoID' => $idphoto,
				':author' => $_SESSION[LOGGED_ON],
				':text' => $_POST[comment]
			));
		}
		catch(PDOException $e)
		{
			echo "Couldn't write in Database: " . $e->getMessage();
		}
		header( "refresh:0;url=gallery.php" );

	}
	
 ?>
