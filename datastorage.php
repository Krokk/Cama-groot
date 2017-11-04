<?php

//var_dump($_POST['data']);
$img = $_POST['data'];
// $img = str_replace('data:image/png;base64,', '', $img);
$img = explode(',', $img);
// $img = str_replace(' ', '+', $img);
$filedata = base64_decode($img);
$filename = 'test.png';
var_dump($img);
file_put_contents($filename, $filedata);

// list(, $img) = explode(';', $img);
// list(, $img) = explode(',', $img);
// $img = base64_decode($img);
// $img = str_replace('data:image/png;base64,', '', $img);
// $img = str_replace(' ', '+', $img);

// print_r($img);
//file_put_contents('test.png', $img);*/

?>
