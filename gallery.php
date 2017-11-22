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
 			<?php
 			if (isset($_SESSION[LOGGED_ON]))
 			{
				echo '<a href="gallery.php"><button class="icon" type="button" name="Gallery"><img src="./ressources/icons/galleryicon.png" style="width:4.5vw;height:4vw;"</img></button></a>';
				echo '<a href="logout.php"><button class="icon" type="button" name="Login"><img src="./ressources/icons/logout.png" style="width:4.5vw;height:4vw;"</img></button></a>';
 			}
 			else
 			{
				echo '<a href="sign_in.php"><button class="icon" type="button" name="Login"><img src="./ressources/icons/logins.png" style="width:4.5vw;height:4vw;"</img></button></a>';
				echo '<a href="sign_up.php"><button class="icon" type="button" name="Sign up"><img src="./ressources/icons/registericon.png" style="width:4.5vw;height:4vw;"</img></button></a>';
				echo '<a href="gallery.php"><button class="icon" type="button" name="Gallery"><img src="./ressources/icons/galleryicon.png" style="width:4.5vw;height:4vw;"</img></button></a>';
 			}
 			?>
 			</div>
		</div>
		<div class="main">
        <?php
            try
            {
            // requete pour recupere les photos par utilisateur
            // $req = $conn->prepare('SELECT url FROM Photos WHERE username = :username ORDER BY timet');
            $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
            $req = $conn->prepare('SELECT url FROM Photos ORDER BY timet DESC');
    		$req->execute();
            $result = $req->fetchAll(PDO::FETCH_COLUMN, 0);
            }
            catch (Exception $e)
            {
                echo "Couldn't read in Database: " . $e->getMessage();
            }
			echo "<div class='galleryview'>";
			foreach ($result as $value)
			{
				echo "<div class='del'>
						<img class='gallery' src='./pics/" . $value . "'/>
						<div class='likebutton'>
							<a href='like.php?pic=" . $value . "'> <img src='./ressources/icons/like.png' style='width:4vw;height=4vw;'/></a>
							<a href='comment.php?pic=" . $value . "'><img src='./ressources/icons/comment.png' style='width:4vw;height=4vw;'/></a>
							</div>
					</div>";

			}
			echo "</div>";
        ?>

		</div>
		<div class="footer">

		</div>

	</body>
</html>
