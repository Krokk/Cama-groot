<?php
	session_start();

	if (!file_exists("./pics"))
		mkdir("./pics");
	$img = $_POST['data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$filedata = base64_decode($img);
	$filepath = "./pics/";
	$filename = $filepath . $_SESSION[LOGGED_ON] . ' ' . time() . '.png';
	file_put_contents($filename, $filedata);

?>
