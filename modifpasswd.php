<?php
	session_start();
	if (!isset($_SESSION['LOGGED_ON']))
		header('location:index.php');

    if(!strlen($_POST['newpasswd']) < 8)
    {
        if(preg_match("#[0-9]+#", $_POST['newpasswd']))
        {
            if(preg_match("#[a-zA-Z]+#", $_POST['newpasswd']))
            {
              try
             {
               $password = hash("sha512", $_POST['newpasswd']);
               $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $update = $conn->prepare("UPDATE users SET password = :newpasswd WHERE username = :username");
               $update->execute(array(
                 ':newpasswd' => $password,
                 ':username' => $_SESSION['LOGGED_ON']
               ));
             }
             catch (Exception $e)
             {
               echo "Couldn't update : " . $e->getMessage();
             }
             header('location:user.php');
            }
            else
            {
                echo "Password must include at least one letter";
                header( "refresh:1;url=user.php" );
            }
        }
        else
        {

            echo "Password must include at least one number";
            header( "refresh:1;url=user.php" );
        }
    }
    else
    {

        echo "Password must be at least 8 characters long";
        header( "refresh:1;url=user.php" );
    }























 ?>
