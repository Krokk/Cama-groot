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
			`conflink` VARCHAR(255) NOT NULL,
			`activated` INT NOT NULL DEFAULT 0,
			`password` VARCHAR(255) NOT NULL,
			`avatar` VARCHAR(100),
			PRIMARY KEY (`id`));
		  ";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`following` (
			`userID` INT NOT NULL,
			`followinguserID` INT NOT NULL,
			PRIMARY KEY (`userID`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`Photos` (
		`UserId` INT NOT NULL,
		`photoID` INT NOT NULL,
		`time` DATETIME NOT NULL,
		`url` VARCHAR(255) NOT NULL,
		PRIMARY KEY (`UserId`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`comments` (
		`UserID` INT NOT NULL,
		`photoID` INT NOT NULL,
		`commentuserID` INT NOT NULL,
		`time` DATETIME NOT NULL,
		`comment` VARCHAR(255) NOT NULL,
		`commentscol` VARCHAR(45) NOT NULL,
		PRIMARY KEY (`UserID`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	try
	{
		$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$qry = "CREATE TABLE `db_camagru`.`likes` (
		`UserID` INT NOT NULL,
		`photoID` INT NOT NULL,
		`userwholikedID` INT NOT NULL,
		`time` DATETIME NOT NULL,
		PRIMARY KEY (`UserID`));
			";
		$conn->exec($qry);
	}
	catch(PDOException $e)
	{
		echo "Couldn't create table: " . $e->getMessage();
	}
	$conn = null;
?>
