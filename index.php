<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Website</title>
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
        <h2>Latest Videos</h2>
        <div class="video-list">
            <?php
            include 'db.php';
            $sql = "SELECT id, file_name, description, upload_date FROM videos ORDER BY upload_date DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $videoId = $row["id"];
                    $video = "uploads/videos/" . $row["file_name"];
                    $description = $row["description"];
                    $uploadDate = $row["upload_date"];
                    echo "<div class='video-item'>
                            <a href='video.php?id=$videoId'>
                                <video width='320' height='240' controls>
                                    <source src='$video' type='video/mp4'>
                                    Your browser does not support the video tag.
                                </video>
                            </a>
                            <p>$description</p>
                            <p><small>Uploaded on: $uploadDate</small></p>
                          </div>";
                }
            } else {
                echo "No videos found.";
            }

            $conn->close();
            ?>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
