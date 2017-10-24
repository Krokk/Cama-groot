<?php
if (isset($_POST[clickme]))
{
	$con = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");	
	$username = $_POST['username'];	
	$request = $con->prepare("SELECT username FROM users WHERE username = :name;");
	$request->bindParam(':name', $username);
	$request->execute();
	if ($request->rowCount() > 0)
	{
		// ameliorer pour que le message derreur saffiche dans le modal directement
		echo "User name already taken	";
	} 
	else 
	{	
		try
			{
				$password = hash("whirlpool", $_POST[password]);
				$bdd = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
				$req = $bdd->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
				$req->execute(array(
					':username' => $_POST['username'],
					':password' => $password));
			}
		catch(PDOException $e)
		{
			echo "Couldn't write in database: " . $e->getMessage();
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
			<div class="box1">
				<a href="sign_in.php"><button class="button" type="button" name="Login">Sign in</button></a>
				<button onclick="document.getElementById('id01').style.display='block'" class="button">Sign up</button>
		<!-- ici le modal -->
		<div id="id01" class="modal">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
			<form class="modal-content animate" action="index.php" method="post">
			<div class="container">
			  <label><b>Users</b></label>
			  <input type="text" placeholder="Enter user name" name="username" required>
			  <label><b>Password</b></label>
			  <input type="password" placeholder="Enter Password" name="password" required>
			  <label><b>Repeat Password</b></label>
			  <input type="password" placeholder="Repeat Password" name="psw-repeat" required>		
			  <div class="clearfix">
				<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				<button type="submit" class="signupbtn" name="clickme">Sign Up</button>
			  </div>
			</div>
		  </form>
		</div>
		<script>
		var modal = document.getElementById('id01');	
		//  fermer la fenetre si on clique a l'exterieur
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		</script>
		
			</div>
		</div>
		<div class="main">
		</div>
		<div class="footer">
		</div>	
	</body>
</html>
