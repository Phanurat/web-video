<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Drive Video Selection</title>
</head>
<body>
    <h1>Choose a Video</h1>
    <ul>
        <li><a href="#" onclick="playVideo('1_P5wF3pHsmBnQUy_u3ePwk8UWbloUS0_')">Video 1</a></li>
        <li><a href="#" onclick="playVideo('VIDEO_ID_2')">Video 2</a></li>
        <!-- Add more video options as needed -->
    </ul>

    <script>
        function playVideo(videoId) {
            window.open('video.php?id=' + videoId, '_blank');
        }
    </script>
</body>
</html>
