<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header ('Content-Type: image/jpeg');
// Load the image from the filename passed in the form
$filename = __DIR__ . '/images/' . $_GET['file'] . '.jpg';
$image = imagecreatefromjpeg($filename);
$w =isset($_GET['width']) ? $_GET['width'] : 500;
$newimg = imagescale($img,$w,$w);
$fontFile = realpath('font/Lato-Medium.ttf');
//check if font file exists
if (!file_exists($fontFile)) {
    die('Error: Font file not found');
}

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

$textColor = imagecolorallocate($newimg,255,255,255);

if ($text1 != '' || $text2 !=''){
    
    imagettftext($newimg,$fontSize1, 0,10,50,$textColor,$fontFile,$text1);
    // get the image height
    $imageHeight = imagesy($newImage);
    // calculate the y-cord for second line of text to be near bottom
    $bottomTextY = $imageHeight - 20;
    imagettftext($newimg,$fontSize2, 0,10,$bottomTextY,$textColor,$fontFile,$text2);
}

imagejpeg($newimg); 



/* // Define the font size and color for the text
$fontSize1 = isset($_GET['size1']) ? $_GET['size1'] : 24;
$fontSize2 = isset($_GET['size2']) ? $_GET['size2'] : 48;
$textColor = imagecolorallocate($newImage, 255, 255, 255); */
/* 
// Add the first line of the text
imagettftext($newImage, $fontSize1, 0, 10, 50, $textColor, $fontFile, $_GET['text1']);

// get the image height
$imageHeight = imagesy($newImage);
// calculate the y-cord for second line of text to be near bottom
$bottomTextY = $imageHeight - 20;

// and second line of text
imagettftext($newImage, $fontSize2, 0, 10, $bottomTextY, $textColor, $fontFile, $_GET['text2']);

// Output the final image
imagejpeg($newImage);
imagedestroy($newImage);
imagedestroy($image); */
?>