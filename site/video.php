<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
</head>
<body>
    <h1>Video Player</h1>
    <?php
    // Check if video ID is provided in URL
    if(isset($_GET['id'])) {
        // Sanitize the input to prevent any security issues
        $videoId = htmlspecialchars($_GET['id']);
        // Echo the iframe with the video ID
        echo '<iframe src="https://drive.google.com/file/d/' . $videoId . '/preview" width="640" height="480" frameborder="0" allowfullscreen></iframe>';
    } else {
        echo '<p>No video ID provided.</p>';
    }
    ?>
</body>
</html>
