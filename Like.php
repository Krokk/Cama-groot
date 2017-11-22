<?php
session_start();
$_SESSION["message"] = '';


try{
    $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = $conn->prepare("SELECT id FROM users where username = :username");
    $req->execute(array(
        ':username' => $_SESSION['LOGGED_ON']
    ));
    $results = $req->fetch();
    
}
// try{

//     $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $req = $conn->prepare('INSERT INTO likes (userid, timet, url) VALUES (:username, NOW() , :url)');
//     $req->execute(array(
//         ':username' => $_SESSION['LOGGED_ON'],
//         ':url' => $filesql
//     ));
// }
catch(PDOException $e)
{
    echo "Couldn't write in Database: " . $e->getMessage();
}

var_dump($result);
// var_dump($_SESSION[LOGGED_ON]);
 ?>
