<?php
// used chatgpt to help refine my code
header('Content-Type: image/jpeg');

//checking for the image file, if its not found then use a default image
if (isset($_GET['image_file'])) {
    $imagePath = "images/" . $_GET['image_file'] . ".jpg";
} else {
    //default image
    $imagePath = "images/default.jpg";
}

//grabbing and generating the image that is selected
$imageResource = imagecreatefromjpeg($imagePath);

//collecting data like the size of image, text size, inputs for top and bottom text, etc
$resizeWidth = isset($_GET['resize_width']) ? $_GET['resize_width'] : 500;
$topText = isset($_GET['top_text']) ? $_GET['top_text'] : "";
$topTextSize = isset($_GET['top_text_size']) ? $_GET['top_text_size'] : 24;
$bottomText = isset($_GET['bottom_text']) ? $_GET['bottom_text'] : "";
$bottomTextSize = isset($_GET['bottom_text_size']) ? $_GET['bottom_text_size'] : 24;

//resizing the image is user chooses to
$resizedImage = imagescale($imageResource, $resizeWidth);

//setting the fonts
$fontPath = realpath('font/Lato-Medium.ttf');
$fontColor = imagecolorallocate($resizedImage, 255, 255, 255); // White text

//where the text gets added on top of image
imagettftext($resizedImage, $topTextSize, 0, 10, 64, $fontColor, $fontPath, $topText);

//where the text gets added on the bottom of image
$imageHeight = imagesy($resizedImage);
imagettftext($resizedImage, $bottomTextSize, 0, 10, $imageHeight - 30, $fontColor, $fontPath, $bottomText);

//showing the meme with the modifications
imagejpeg($resizedImage);

imagedestroy($imageResource);
imagedestroy($resizedImage);
?>
