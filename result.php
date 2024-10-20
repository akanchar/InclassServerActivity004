<?php
// tell the browser this is an image
header('Content-Type: image/jpeg');

// check if the file parameter is set, else use a default image
if (isset($_GET['file'])) {
    $imgname = "images/" . $_GET['file'] . ".jpg";
} else {
    // Default image if none is provided
    $imgname = "images/default.jpg";
}

// create the image from the selected file
$img = imagecreatefromjpeg($imgname);

// get form data using the $_GET array
$width = isset($_GET['width']) ? $_GET['width'] : 500;
$text1 = isset($_GET['text1']) ? $_GET['text1'] : "";
$size1 = isset($_GET['size1']) ? $_GET['size1'] : 24;
$text2 = isset($_GET['text2']) ? $_GET['text2'] : "";
$size2 = isset($_GET['size2']) ? $_GET['size2'] : 24;

// resize image based on provided width
$img_resized = imagescale($img, $width);

// set font properties
$fontFile = realpath('font/Lato-Medium.ttf');
$textColor = imagecolorallocate($img_resized, 255, 255, 255); // White text

// add meme 1 text to the top of the image
imagettftext($img_resized, $size1, 0, 10, 40, $textColor, $fontFile, $text1);

// add meme 2 text to the bottom of the image
$img_height = imagesy($img_resized);
imagettftext($img_resized, $size2, 0, 10, $img_height - 30, $textColor, $fontFile, $text2);

// output the final image as a JPEG
imagejpeg($img_resized);

// cleanup
imagedestroy($img);
imagedestroy($img_resized);
?>
