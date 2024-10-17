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

// Output the final image
imagejpeg($newImage);
imagedestroy($newImage);
?>