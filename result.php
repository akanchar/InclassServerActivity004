<?php
// Include the data file to get the list of filenames
include 'data.inc.php';

// Set content type to image/jpeg
header('Content-Type: image/jpeg');

// Get parameters from $_GET with default values
$file = isset($_GET['file']) ? $_GET['file'] : '017040'; // Default file
$width = isset($_GET['width']) ? intval($_GET['width']) : 500; // Default width

$text1 = isset($_GET['text1']) ? $_GET['text1'] : '';
$size1 = isset($_GET['size1']) ? intval($_GET['size1']) : 24; // Default font size for text1

$text2 = isset($_GET['text2']) ? $_GET['text2'] : '';
$size2 = isset($_GET['size2']) ? intval($_GET['size2']) : 24; // Default font size for text2

// Validate 'file' parameter against allowed filenames
$allowedFiles = array_column($paintings, 'filename');
if (!in_array($file, $allowedFiles)) {
    die('Invalid image file.');
}

// Build the image filename
$imgname = "images/" . $file . ".jpg";

// Check if the image file exists
if (!file_exists($imgname)) {
    die('Image not found.');
}

// Create the image from the file
$img = imagecreatefromjpeg($imgname);

// Resize the image to the specified width and height (square image)
$newimg = imagescale($img, $width, $width);

// Set font file paths
$fontFileHeavy = realpath('font/Lato-Heavy.ttf');
$fontFileLight = realpath('font/Lato-Light.ttf');

// Set text color (white)
$textColor = imagecolorallocate($newimg, 255, 255, 255); // White

// Only add text if text parameters are provided
if (!empty($text1) && !empty($size1)) {
    // Add Meme 1 Text to the image
    $fontSize1 = $size1;
    $x1 = 20;
    $y1 = $fontSize1 + 20;

    // Add Meme 1 Text using Lato-Light font
    imagettftext($newimg, $fontSize1, 0, $x1, $y1, $textColor, $fontFileLight, $text1);
}

if (!empty($text2) && !empty($size2)) {
    // Add Meme 2 Text to the image
    $fontSize2 = $size2;
    $x2 = 20;
    // Adjust y2 to position text above the bottom edge by font size and margin
    $y2 = $width - $fontSize2 - 20;

    // Add Meme 2 Text using Lato-Heavy font
    imagettftext($newimg, $fontSize2, 0, $x2, $y2, $textColor, $fontFileHeavy, $text2);
}

// Output the image to the browser
imagejpeg($newimg);

// Free memory
imagedestroy($newimg);
imagedestroy($img);
?>