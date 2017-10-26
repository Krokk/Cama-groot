<?php
	try
	{
		$conn = new PDO("mysql:host=localhost", "root", "root");
		$req = "CREATE DATABASE db_camagru";
		$req = $conn->prepare($req);
		$req->execute();
		header("location:index.php");
	}
	catch(PDOException $e)
	{
		echo "Error creating DataBase: " . $e->getMessage();	
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`users` (
			`id` INT NOT NULL AUTO_INCREMENT,
			`username` VARCHAR(100) NOT NULL,
			`email` VARCHAR(100) NOT NULL,
			`password` VARCHAR(100) NOT NULL,
			`avatar` VARCHAR(100) NOT NULL,
			PRIMARY KEY (`id`));
		  ";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create DB: " . $e->getMessage();
	}
	$conn = null;
?>
