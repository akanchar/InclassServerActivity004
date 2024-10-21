<?php
header('Content-Type: image/jpeg');

$imgname = 'images/' . basename($_GET['file']) . '.jpg';
$img = imagecreatefromjpeg($imgname);
$w = isset($_GET['width']) ? intval($_GET['width']) : 100;
$newimg = imagescale($img, $w, $w);
$fontFile = realpath('font/Lato-Medium.ttf');
$fontSize1 = isset($_GET['size1']) ? intval($_GET['size1']) : 20;
$fontSize2 = isset($_GET['size2']) ? intval($_GET['size2']) : 20;
$text1 = isset($_GET['text1']) ? $_GET['text1'] : '';
$text2 = isset($_GET['text2']) ? $_GET['text2'] : '';

//imgcords and color
$x1 = 50; $y1 = 40; $x2 = 50 ;$y2 = $w- 40;
$textColor = imagecolorallocate($newimg, 238, 238, 238);

//add text
if ($text1) {
    imagettftext($newimg, $fontSize1, 0, $x1, $y1, $textColor, $fontFile, $text1);
}if ($text2) {
    imagettftext($newimg, $fontSize2, 0, $x2, $y2, $textColor, $fontFile, $text2);
}

imagejpeg($newimg);
?>
