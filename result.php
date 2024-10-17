<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set header for image output
header('Content-Type: image/jpeg');

// Load the image from the filename passed in the form
$filename = __DIR__ . '/images/' . $_GET['file'] . '.jpg';
$image = imagecreatefromjpeg($filename);

// Get the width value from the form (default to 500 if not set)
$width = isset($_GET['width']) ? $_GET['width'] : 500;
$newImage = imagescale($image, $width);

// Define the font file path (ensure the font file is in the correct directory)
$fontFile = __DIR__ . '/font/Lato-Medium.ttf';

// Check if the fonr file exsists
if (!file_exists($fontFile)) {
    die('Error: Font file not found');
}

// Define the font size and color for the text
$fontSize1 = isset($_GET['size1']) ? $_GET['size1'] : 24;
$fontSize2 = isset($_GET['size2']) ? $_GET['size2'] : 48;
$textColor = imagecolorallocate($newImage, 255, 255, 255);

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
imagedestroy($image);
?>