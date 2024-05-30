<?php
if (isset($_GET['video'])) {
    $video = $_GET['video'];
} else {
    echo "No video specified!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video - <?php echo htmlspecialchars($video); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Video Website</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="upload.php">Upload</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2><?php echo htmlspecialchars($video); ?></h2>
        <video width="640" height="480" controls>
            <source src="uploads/videos/<?php echo htmlspecialchars($video); ?>" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
