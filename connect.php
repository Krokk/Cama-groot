<?php
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "elefant1");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connection established";
	}
	catch(PDOException $e)
	{
		header("location:install.php");
	}
?>
