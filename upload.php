<?php
$target_dir = "./pics/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<div class='uploadmsg'>File is not an image.</div>";
        $uploadOk = 0;
    }
}

if (file_exists($target_file)) {
    echo "<div class='uploadmsg'>Sorry, file already exists.</div>";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "<div class='uploadmsg'>Sorry, your file is too large.</div>";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "GIF" && $imageFileType != "PNG") {
    echo "<div class='uploadmsg'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "<div class='uploadmsg'>Sorry, your file was not uploaded.</div>";

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<div class='uploadmsg'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</div>";
    } else {
        echo "<div class='uploadmsg'>Sorry, there was an error uploading your file.</div>";
    }
}
?>