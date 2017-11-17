<?php
	session_start();

	if (!file_exists("./pics"))
		mkdir("./pics");
	$filter = "./filters/" . $_POST['filter'] . ".png";
	$img = $_POST['data'];

	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$filedata = base64_decode($img);
	$filepath = "./pics/";
	$filename = $filepath . $_SESSION[LOGGED_ON] . " " . time() . '.png';

	if (file_exists($filter))
	{
		$dest = imagecreatefromstring($filedata);
		$src = imagecreatefrompng($filter);
		$src = imagescale($src, imagesx($dest) * 0.5);
		imagecopy($dest, $src, 0, 0, 0, 0, imagesx($src) - 1, imagesy($src) - 1);
		imagepng($dest, $filename);
	}

	echo $filename;
?>
