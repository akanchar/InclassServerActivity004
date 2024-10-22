<?php
include 'data.inc.php';

if (isset($_GET['file']) && isset($_GET['text1']) && isset($_GET['size1']) && isset($_GET['text2']) && isset($_GET['size2']) && isset($_GET['width'])) {
    
    $filename = $_GET['file'];
    $text1 = $_GET['text1'];
    $size1 = $_GET['size1'];
    $text2 = $_GET['text2'];
    $size2 = $_GET['size2'];
    $width = $_GET['width'];

    // Find the painting by filename
    $painting = array_filter($paintings, function($p) use ($filename) {
        return $p['filename'] === $filename;
    });
    $painting = array_shift($painting); // Extract the painting from the filtered result

    // Set the image file path based on the filename
    $imagePath = "images/{$filename}.jpg"; // Ensure images are stored in "images" directory
    
    if (file_exists($imagePath)) {
        // Load the image
        $image = imagecreatefromjpeg($imagePath);

        // Get original image dimensions
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);
        
        // Scale the image to the specified width, maintaining aspect ratio
        $newHeight = ($width / $origWidth) * $origHeight;
        $scaledImage = imagescale($image, $width, $newHeight);

        // Add text to the image
        $textColor = imagecolorallocate($scaledImage, 255, 255, 255); // White text color
        $font = __DIR__ . '/fonts/arial.ttf'; // Ensure a font file is available
        
        // Add Meme 1 text
        imagettftext($scaledImage, $size1, 0, 10, 30, $textColor, $font, $text1);
        
        // Add Meme 2 text
        imagettftext($scaledImage, $size2, 0, 10, $newHeight - 30, $textColor, $font, $text2);

        // Output the image as JPEG
        header("Content-Type: image/jpeg");
        imagejpeg($scaledImage);
        
        // Free up memory
        imagedestroy($scaledImage);
        imagedestroy($image);
    } else {
        echo "Image not found.";
    }
} else {
    echo "Required parameters are missing.";
}
?>
