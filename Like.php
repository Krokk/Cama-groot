<?php
session_start();
$_SESSION["message"] = '';

    $picname = $_POST['pic'];

    try{
    $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $conn->prepare("SELECT id FROM users where username = :username");
    $req->execute(array(
        ':username' => $_SESSION['LOGGED_ON']
    ));
    $id = $req->fetch(PDO::FETCH_COLUMN, 0);      
    }
    catch(PDOException $e)
    {
        echo "Couldn't write in Database: " . $e->getMessage();
    }

    try{
        $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = $conn->prepare("SELECT PhotoID FROM photos where url = :url");
        $req->execute(array(
            ':url' => $picname
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
        $req = $conn->prepare('INSERT INTO likes (userid, photoid, timet) VALUES (:userid, :photoid, NOW()');
        $req->execute(array(
            ':userid' => $id,
            ':photoid' => $idphoto,
        ));
    }
    catch(PDOException $e)
    {
        echo "Couldn't write in Database: " . $e->getMessage();
    }
 ?>
