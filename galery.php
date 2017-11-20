<?php
session_start();
$_SESSION[message] = '';
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
			<div class="box1">
 			<?php
 			if (isset($_SESSION[LOGGED_ON]))
 			{
 				echo '<a href="profile.php"><button class="signed" style="padding-left: 0px;type="button" name="profile">' . $_SESSION[LOGGED_ON] ."</button></a>";
 				echo '<a href="logout.php"><button class="button" type="button" name="Logout">Log out</button></a>';
 			}
 			else
 			{
 				echo '<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>';
 				echo '<a href="sign_up.php"><button class="button" type="button" name="Sign up">Sign up</button></a>';
 			}
 			?>
 			</div>
		</div>
		<div class="main">
        <?php
        if ($_SESSION[LOGGED_ON])
        {
            try
            {
            // requete pour recupere les photos par utilisateur
            // $req = $conn->prepare('SELECT url FROM Photos WHERE username = :username ORDER BY timet');
            $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
            $req = $conn->prepare('SELECT url FROM Photos ORDER BY timet');
    		$req->execute();
            $result = $req->fetchAll(PDO::FETCH_COLUMN, 0);
            }
            catch (Exception $e)
            {
                echo "Couldn't read in Database: " . $e->getMessage();
            }
			foreach ($result as $value)
			{
				echo "<div class='del'>
						<img class='gallery' src='./pics/" . $value . "'/>
					</div>";

			}
        }
        ?>

		</div>
		<div class="footer">

		</div>

	</body>
</html>
