<?php
if (!$_POST['filter'])
{
    header('Location:index.php');
 }
  $target_dir = "pics/";
	$filter = $_POST['filter'];
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	if(isset($_POST["submit"])) {

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$toto = finfo_file($finfo, $_FILES["fileToUpload"]["tmp_name"]);
		 if ($toto == 'image/gif' || $toto == 'image/jpeg' || $toto == 'image/png' || $toto == 'image/jpg' && $uploadOk === 1)
		 {
			if ((getimagesize($_FILES["fileToUpload"]["tmp_name"])) == FALSE)
		 	{
					header( "refresh:2;url=index.php" );
	        echo "<div class='uploadmsg'>File is not an image. Redirecting.</div>";
			}
			else if (file_exists($target_file) == TRUE)
			{
				header( "refresh:2;url=index.php" );
	    		echo "<div class='uploadmsg'>Sorry, file already exists. Redirecting</div>";
			}
			else if ($_FILES["fileToUpload"]["size"] > 50000000)
			{
				header( "refresh:2;url=index.php" );
				echo "<div class='uploadmsg'>Sorry, your file is too large. Redirecting</div>";
			}

			else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "GIF" && $imageFileType != "PNG")
			{
				header( "refresh:2;url=index.php" );
				echo "<div class='uploadmsg'>Sorry, only JPG, JPEG, PNG & GIF files are allowed. Redirecting</div>";
			}
			else
			{
		    	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
			 	{
					header( "refresh:2;url=dataupload.php?filter=" . $filter . "&data=" . basename( $_FILES["fileToUpload"]["name"]));
	  				echo "<div class='uploadmsg'>The file ". basename( $_FILES["fileToUpload"]["name"]) . " has been uploaded.</div>";
				}
				else
			 	{
					header( "refresh:4;url=index.php" );
					echo "<div class='uploadmsg'>Sorry, there was an error uploading your file. Redirecting</div>";
				}
			}
		}
		else
    {
			   header("refresh:2;url=index.php");
				echo "Your File Isn't a valid type. redirecting.";
		}
}
?>
