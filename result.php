<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//set header for image output
header ('Content-Type: image/jpeg');

// Load the image from the filename passed in the form
$filename = 'images/' . $_GET['file'] .'.jpg';
$img = imagecreatefromjpeg($filename);
if (!$img) {
    die('Error loading image.');
}

$w = isset($_GET['width']) ? $_GET['width'] : 500;
$newimg = imagescale($img,$w,$w);

$fontFile = realpath('font/Lato-Medium.ttf');
$textColor = imagecolorallocate($newimg,255,255,255);

if(!$_GET['size1']){
    $fontSize1 = 24;
}
else{
    $fontSize1 = $_GET['size1'];
}


if(!$_GET['size2']){
    $fontSize2 = 48;
}
else{
    $fontSize2 = $_GET['size2'];
}

if (!$_GET['text1']){
    $text1 = '';
}
else{
    $text1 = $_GET['text1'];
}

if (!$_GET['text2']){
    $text2 = '';
}
else{
    $text2 = $_GET['text2'];
}
// get the image height
$imageHeight = imagesy($newimg);
// calculate the y-cord for second line of text to be near bottom
$bottomTextY = $imageHeight - 20;

if(!empty($text1)){
    imagettftext($newimg,$fontSize1, 0,10,50,$textColor,$fontFile,$text1);
}

if(!empty($text2)){
    imagettftext($newimg,$fontSize2, 0,10,$bottomTextY,$textColor,$fontFile,$text2);
}

imagejpeg($newimg); 
imgd

?>
