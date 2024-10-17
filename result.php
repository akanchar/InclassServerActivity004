<?php

header ('Content-Type: image/jpeg');

$imgname = 'images/' . $_GET['file'] .'.jpg';
$img = imagecreatefromjpeg($imgname);
$w = $_GET['width'];
$newimg = imagescale($img,$w,$w);
$fontFile = realpath('font/Lato-Medium.ttf');

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

$textColor = imagecolorallocate($newimg,238,238,238);

if ($text1 != '' || $text2 !=''){
    
    imagettftext($newimg,$fontSize1, 0,100,75,$textColor,$fontFile,$text1);
    imagettftext($newimg,$fontSize2, 0,100,450,$textColor,$fontFile,$text2);
}

imagejpeg($newimg); 

?>