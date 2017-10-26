<?php
session_start();
if (isset($_POST[clickme]))
{
    //TODO : englober tout les tests de check dans une fonction, et seulement si tout les tests sont passes passer dans le else
    if ((isset($_POST[clickme])) and (($_POST['password']!= $_POST['psw-repeat'])))
    {
        $psw_msg = "<div>Your password must match</div><br>";
    }
    if (!preg_match("/^[a-zA-Z]*$/",$username = $_POST['username']))
    {
        $user_msg = "Invalid username use only letter or numbers<br>"; 
    }
    if (!filter_var($email = $_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $email_msg = "Invalid email format<br>"; 
    }
    else
    { 
        $con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");	
        $request = $con->prepare("SELECT username FROM users WHERE username = :name;");
        $request->bindParam(':name', $username);
        $request->execute();
        if ($request->rowCount() > 0)
        {
            $user_msg = "<div>Username already taken</div><br>";
        }
        else 
        {	
            try
                {
                    $password = hash("whirlpool", $_POST[password]);
                    $bdd = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
                    $req = $bdd->prepare('INSERT INTO users (username, password, email) VALUES (:username, :password, :email)');
                    $req->execute(array(
                        ':username' => $_POST['username'],
                        ':password' => $password,
                        ':email' => $_POST['email']));
                }
            catch(PDOException $e)
            {
                echo "Couldn't write in database: " . $e->getMessage();
            }
            if (!$e)
            {
                $_SESSION["users"] = $username;
                header( "refresh:0;url=account_created.php" );
            }
        }
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
            <form class="modal-content" action="#" method="post">
            <div class="container">
                <label><b>Users</b></label>
                <input type="text" placeholder="Enter user name" name="username" required>
                <?php
		        	if(isset($user_msg)){ echo $user_msg;}
                ?>
                <label><b>Email</b></label>
                <input type="text" placeholder="Enter email address" name="email" required>
                <?php
		        	if(isset($email_msg)){ echo $email_msg;}
		        ?>
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <?php
		        	if(isset($psw_msg)){ echo $psw_msg;}
		        ?>
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
