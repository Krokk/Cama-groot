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
		echo "Connection failed: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE users (username VARCHAR(255), password VARCHAR(255))";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create DB: " . $e->getMessage();
	}
	$conn = null;
?>
