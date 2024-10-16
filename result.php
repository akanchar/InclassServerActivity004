<?php
header ('Content-Type: image/jpeg');

$imgname = 'images/' . $_GET['file'] . '.jpg';
$img = imagecreatefromjpeg($imgname);
$w = $_GET['width'];
$newimg = imagescale($img,$w,$w);
$fontFile = realpath('font/Lato-Medium.ttf');
$fontSize1 = $_GET['size1'];
$fontSize2 = $_GET['size2'];
$text1 = $_GET['text1'];
$text2 = $_GET['text2'];
$textColor = imagecolorallocate($newimg,238,238,238);
imagettftext($newimg,$fontSize1, 0,50,100,$textColor,$fontFile,$text1);
imagettftext($newimg,$fontSize2, 0,50,150,$textColor,$fontFile,$text2);
imagejpeg($newimg);
imagedestroy($img);
imagedestroy($newimg);
?>