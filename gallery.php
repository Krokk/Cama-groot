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
	<body onload="setInterval('scroll();', 250);">
    
	
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
		<div id="header">Web Gallery | Infinite Scroll</div>
    <div id="container">   
	<!-- <img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" />
	<img src="pics/test1 1511908057.png" /> -->
        <!-- <p>9 Images Displayed | <a href="#header">top</a></p> -->
        <!-- <hr /> -->
    </div>

        <?php
            try
            {
            // requete pour recupere les photos par utilisateur
            // $req = $conn->prepare('SELECT url FROM Photos WHERE username = :username ORDER BY timet');
            $conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
            $req = $conn->prepare('SELECT url, PhotoID FROM Photos ORDER BY timet DESC');
    		$req->execute();
            $result = $req->fetchAll();
            }
            catch (Exception $e)
            {
                echo "Couldn't read in Database: " . $e->getMessage();
            }
			// echo "<div class='galleryview'>";
			// foreach ($result as $value)
			// {
			// 	echo "<div class='del'>
			// 	<img class='gallery' src='./pics/" . $value[url] . "'/>";
			// 	if (isset($_SESSION[LOGGED_ON]))
			// 	{
			// 		echo "<div class='likebutton'>
			// 				<a href='like.php?pic=" . $value[url] . "'> <img src='./ressources/icons/like.png' style='width:4vw;height=4vw;'/></a>
			// 				<a href='comment.php?pic=" . $value[url] . "'><img src='./ressources/icons/comment.png' style='width:4vw;height=4vw;'/></a>
			// 				</div>";
				
			// 		echo "<div class='likencomment'>";
			// 		try
			// 		{
			// 			$conn = new PDO("mysql:host=localhost;dbname=db_camagru", "root", "root");
			// 			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// 			$req = $conn->prepare("SELECT LikeID FROM likes WHERE photoID = :photoID");
			// 			$req->execute(array(
			// 				':photoID' => $value[PhotoID]
			// 			));
			// 		}
			// 		catch(PDOException $e)
			// 		{
			// 			echo "Couldn't write in Database: " . $e->getMessage();
			// 		}
			// 		$count = $req->rowCount();
			// 		echo $count . '  ❤' ;
			// 		echo "</div>";
			// 	}
			// echo "</div>";
			// }
			
		// echo "</div>";
		?>
		</div>
		<div class="footer">
		</div>
	</body>
</html>

<script>
var contentHeight = 800;
var pageHeight = document.documentElement.clientHeight;
var scrollPosition;
var n = 0;
var xmlhttp;
 
function putImages(){
     
    if (xmlhttp.readyState==4)
      {
          if(xmlhttp.responseText){
             var resp = xmlhttp.responseText.replace("\r\n", ""); 
             var files = resp.split(";");
              var j = 0;
              for(i=0; i<files.length; i++){
                  if(files[i] != ""){
                     document.getElementById("container").innerHTML += '<img class="del" src="pics/'+files[i]+'" />';
                     j++;
                   
                     if(j == 3 || j == 6)
                          document.getElementById("container").innerHTML += '';
                      else if(j == 9){
                          document.getElementById("container").innerHTML += '<p>'+(n-1)+" Images Displayed | <a href='#header'>top</a></p><hr />";
                          j = 0;
                      }
                  }
              }
          }
      }
}
         
         
function scroll(){
     
    if(navigator.appName == "Microsoft Internet Explorer")
        scrollPosition = document.documentElement.scrollTop;
    else
        scrollPosition = window.pageYOffset;        
     
    if((contentHeight - pageHeight - scrollPosition) < 500){
                 
        if(window.XMLHttpRequest)
            xmlhttp = new XMLHttpRequest();
        else
            if(window.ActiveXObject)
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            else
                alert ("Bummer! Your browser does not support XMLHTTP!");         
           
        var url="getImages.php?n="+n;
         
        xmlhttp.open("GET",url,true);
        xmlhttp.send();
        n += 9;
        xmlhttp.onreadystatechange=putImages;       
        contentHeight += 400;       
    }
}
 
</script>