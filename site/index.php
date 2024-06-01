<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Drive Video Selection</title>
</head>
<body>
    <h1>Choose a Video</h1>
    <li><a href="upload/upload-form.php">Upload</a></li>
    <ul>
        <?php
        // Include the database configuration file
        include '../db.php';

        // Fetch video data from the database
        $sql = "SELECT * FROM videos_drive";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<li><a href="#" onclick="playVideo(\'' . $row['google_drive_id'] . '\')">' . $row['video_name'] . '</a></li>';
            }
        } else {
            echo "0 results";
        }
        ?>
    </ul>

    <script>
        function playVideo(videoId) {
            window.open('video.php?id=' + videoId, '_blank');
        }
    </script>
</body>
</html>
