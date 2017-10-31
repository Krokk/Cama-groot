<?php
session_start();
$_SESSION["message"] = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST['password'] == $_POST['psw-repeat'])
    {
        if (preg_match("/^[a-zA-Z0-9]*$/", $username = $_POST['username']))
        {
            try
            {
                $email = $_POST[email];
                $con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
                $request = $con->prepare("SELECT email FROM users WHERE email = :email;");
                $request->bindParam(':email', $email);
                $request->execute();
                if ($request->rowCount() > 0)
                    $_SESSION['message'] ='Email already used';
            }
            catch(PDOException $e)
            {
                echo "Couldn't write in database: " . $e->getMessage();
            }
            if (filter_var($email = $_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                try
                {
                    $con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
                    $request = $con->prepare("SELECT username FROM users WHERE username = :name;");
                    $request->bindParam(':name', $username);
                    $request->execute();
                    if ($request->rowCount() > 0)
                        $_SESSION['message'] ='Username already taken';
                }
                catch(PDOException $e)
                {
                    echo "Couldn't write in database: " . $e->getMessage();
                }
                try
                {
                    $conflink = md5( rand(0,1000) );
                    $password = hash("sha512", $_POST[password]);
                    $bdd = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
                    $req = $bdd->prepare('INSERT INTO users (username, password, email, conflink) VALUES (:username, :password, :email, :conflink)');
                    $req->execute(array(
                        ':username' => $_POST['username'],
                        ':password' => $password,
                        ':email' => $email,
                        ':conflink' => $conflink));
                }
                catch(PDOException $e)
                {
                    echo "Couldn't write in database: " . $e->getMessage();
                }
                $to       =  $email;
                $subject  = 'Signup | Verification';
                $message  = '

                Thanks for signing up!
                Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                ------------------------
                Username: '.$username.'
                ------------------------

                Please click this link to activate your account:
                http://localhost:8888/Camagru/verify.php?email='.$email.'&conflink='.$conflink.'

                ';

                $headers = 'From:noreply@camagru.com' . "\r\n";
                mail($to, $subject, $message, $headers);
                header( "refresh:0;url=account_created.php" );            
            }
            else
            {
                $_SESSION['message'] = 'Invalid email format';
            }
        }
        else
        {
            $_SESSION['message'] = 'Invalid username use only letters or numbers';
        }
    }
    else
    {
        $_SESSION["message"] = "Your password must match";
    }
}
?>
<html>
	<head>
		<link rel="stylesheet" href="styles.css">
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<div class="header">
		    <a href="index.php"><button class="title" name="button">CAMAGRU</button><a/>
		</div>
		<div class="main">
            <form class="modal-content" action="sign_up.php" method="post">
            <div class="container">
                <div class="log_error"><?= $_SESSION["message"] ?></div>
                <label><b>Users</b></label>
                <input type="text" placeholder="Enter user name" name="username" required>

                <label><b>Email</b></label>
                <input type="email" placeholder="Enter email address" name="email" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                <div class="clearfix" style="text-align: center;">
                    <a href="index.php"><button class="signup" type="button" name="Cancel">Cancel</button></a>
                    <button type="submit" class="signup" name="clickme" style= "margin-left: 2%";>Sign Up</button>
                </div>
            </div>
            </form>
        </div>
	</div>
	<div class="footer">
	</div>

	</body>
</html>
