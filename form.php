<?php
  include 'data.inc.php'; // Include the paintings array
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>  
    <title>Lab 12</title>   
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,800" rel="stylesheet">    
    <link rel="stylesheet" href="css/style.css">
    <script src="js/severactivity.js"></script>
</head>
<body>
    <h1>Fine Art Meme Maker</h1> 

    <!-- Generate Thumbnails using a loop -->
    <section class="grid-container">
        <?php
        // Loop through the paintings array and generate an <img> for each one
        foreach ($paintings as $painting) {
            // Debugging: Check if the image file exists
            $fileName = "{$painting['filename']}";
            $imgSrc = "result.php?file={$fileName}&width=100&meme=no"; 
            echo "<img src='{$imgSrc}' data-value='{$fileName}' class='img'>";
            // echo "<p>Debug: {$imgSrc}</p>"; // This will display the image path for debugging
        }
        ?>
    </section>     

    <!-- Meme creation form -->
    <form action="result.php" method="get">
        <label>Select Base Painting:</label>
        <select name="file" id="whichPainting">
            <?php
            // Dynamically populate the dropdown options for paintings
            foreach ($paintings as $painting) {
                echo "<option value='{$painting['filename']}'>{$painting['title']} by {$painting['artist']}</option>";
            }
            ?>
        </select>
        <input type="hidden" name="meme" value="yes" />

        <label>Meme 1 Text:</label>
        <input type="text" name="text1" size=50 value="Default text" />

        <label>Meme 1 Font Size:</label>
        12 <input type="range" name="size1" min=12 max=64 value=24 /> 64

        <label>Meme 2 Text:</label>
        <input type="text" name="text2" size=50 value="More text"/>   

        <label>Meme 2 Font Size:</label>
        12 <input type="range" name="size2" min=12 max=48 value=48 /> 48  

        <label>Image Width:</label>
        500 <input type="range" name="width" min=500 max=1000 value=500 /> 1000

        <input type="submit" value="Click To See Meme" >
    </form>
</body>
</html>
