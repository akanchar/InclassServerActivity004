<?php
// Set the header to tell the browser we're returning an image
header('Content-Type: image/jpeg');

// Get the file name from the GET request
$file = $_GET['file']; // Filename of the painting image
$imagePath = "images/$file.jpg"; // Construct the image path

// Check if the image file exists
if (!file_exists($imagePath)) {
    die("Error: Image not found at $imagePath"); // Error message if not found
}

// Create an image resource from the JPEG file
$img = imagecreatefromjpeg($imagePath);
if (!$img) {
    die("Error: Could not create image from $imagePath"); // Error message if creation fails
}

// Resize the image based on the requested width (if needed)
$width = (int)$_GET['width']; // Ensure width is an integer
list($originalWidth, $originalHeight) = getimagesize($imagePath); // Get original dimensions
$newHeight = ($originalHeight / $originalWidth) * $width; // Calculate new height maintaining aspect ratio
$newImg = imagescale($img, $width, $newHeight); // Scale the image to new dimensions

// Check if the overlay text and sizes are provided before using them
$text1 = isset($_GET['text1']) ? $_GET['text1'] : '';  // Default to an empty string if not provided
$size1 = isset($_GET['size1']) ? (int)$_GET['size1'] : 24;  // Default font size for text1
$text2 = isset($_GET['text2']) ? $_GET['text2'] : ''; // Default to an empty string for text2
$size2 = isset($_GET['size2']) ? (int)$_GET['size2'] : 24; // Default font size for text2

// Define the font file path
$fontFile = realpath('font/Lato-Medium.ttf');  // Correct path to your font file
if (!file_exists($fontFile)) {
    die("Error: Font file not found at $fontFile"); // Error message if font file is not found
}

// Ensure the correct path to the font file
$textColor = imagecolorallocate($newImg, 255, 255, 255);  // Set text color to white

// Add the first text overlay (if provided)
if (!empty($text1)) {
    imagettftext($newImg, $size1, 0, 10, 50, $textColor, $fontFile, $text1); // Overlay first text
}

// Add the second text overlay (if provided)
if (!empty($text2)) {
    imagettftext($newImg, $size2, 0, 10, $newHeight - 50, $textColor, $fontFile, $text2); // Overlay second text
}

// Output the final image to the browser
imagejpeg($newImg);

// Free up memory by destroying the images
imagedestroy($newImg); // Destroy the new scaled image
imagedestroy($img); // Destroy the original image resource
?>
