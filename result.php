<?php
// Tell the browser this is an image
header('Content-Type: image/jpeg');

// Correct the image path
if (!isset($_GET['file'])) {
    die("Error: 'file' parameter is missing.");
}

$imgname = "images/" . $_GET['file'] . ".jpg";

// Check if the image file exists
if (!file_exists($imgname)) {
    die("Error: Image file not found: " . $imgname);
}

$img = imagecreatefromjpeg($imgname);

// Check if the width query string is present and use imagescale to resize the image
if (isset($_GET['width'])) {
    $w = $_GET['width'];
    // Use the width for both width and height to make it a square
    $newimg = imagescale($img, $w, $w);
} else {
    // If no width is provided, keep the original image dimensions
    $newimg = $img;
}

if (!isset($_GET['meme'])) {
    die("Error: 'meme' parameter is missing.");
}
elseif ($_GET['meme'] == "yes") {

        // Check if the text sizes and text strings are set
    if (!isset($_GET['size1'])) {
        die("Error: 'size1' parameter is missing.");
    }
    if (!isset($_GET['text1'])) {
        die("Error: 'text1' parameter is missing.");
    }
    if (!isset($_GET['size2'])) {
        die("Error: 'size2' parameter is missing.");
    }
    if (!isset($_GET['text2'])) {
        die("Error: 'text2' parameter is missing.");
    }

    // Add Meme 1 text to the image
    $fontFile = realpath('font/Lato-Medium.ttf');
    if (!file_exists($fontFile)) {
        die("Error: Font file not found: " . $fontFile);
    }

    $fontSize1 = $_GET['size1'];
    $textColor = imagecolorallocate($newimg, 238, 238, 238);
    imagettftext($newimg, $fontSize1, 0, 250, 160, $textColor, $fontFile, $_GET['text1']);

    // Add Meme 2 text to the image
    $fontSize2 = $_GET['size2'];
    imagettftext($newimg, $fontSize2, 0, 250, 300, $textColor, $fontFile, $_GET['text2']);

}

else {

}
// Now return the image to the requesting browser
imagejpeg($newimg);

// Free up memory
imagedestroy($newimg);
imagedestroy($img);
?>
