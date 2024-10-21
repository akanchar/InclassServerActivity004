<?php
// Set the header to tell the browser we're returning an image
header('Content-Type: image/jpeg');

// Get the file name from the GET request
$file = $_GET['file'];

$imagePath = "images/$file.jpg"; // Construct the image path
if (!file_exists($imagePath)) {
    die("Error: Image not found at $imagePath");
}

$img = imagecreatefromjpeg($imagePath);
if (!$img) {
    die("Error: Could not create image from $imagePath");
}


// Resize the image based on the requested width (if needed)
$width = $_GET['width'];
list($originalWidth, $originalHeight) = getimagesize($imagePath);
$newHeight = ($originalHeight / $originalWidth) * $width;
$newImg = imagescale($img, $width, $newHeight);

// Check if the overlay text and sizes are provided before using them
$text1 = isset($_GET['text1']) ? $_GET['text1'] : '';  // Default to an empty string if not provided
$size1 = isset($_GET['size1']) ? $_GET['size1'] : 24;  // Default font size
$text2 = isset($_GET['text2']) ? $_GET['text2'] : '';
$size2 = isset($_GET['size2']) ? $_GET['size2'] : 24;


$fontFile = realpath('font/Lato-Medium.ttf');  // Correct path to your font file
if (!file_exists($fontFile)) {
    die("Error: Font file not found at $fontFile");
}// Ensure the correct path to the font file

$textColor = imagecolorallocate($newImg, 255, 255, 255);  // Set text color to white

// Add the first text overlay (if provided)
if (!empty($text1)) {
    imagettftext($newImg, $size1, 0, 10, 50, $textColor, $fontFile, $text1);
}

// Add the second text overlay (if provided)
if (!empty($text2)) {
    imagettftext($newImg, $size2, 0, 10, $newHeight - 50, $textColor, $fontFile, $text2);
}

// Output the final image to the browser
imagejpeg($newImg);

// Free up memory
imagedestroy($newImg);
?>
