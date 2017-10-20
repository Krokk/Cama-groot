<?php
	try
	{
		$conn = new PDO("mysql:host=localhost", "root", "elefant1");
		$req = "CREATE DATABASE db_camagru";
		$req = $conn->prepare($req);
		$req->execute();
		header("location:index.html");
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "elefant1");
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
