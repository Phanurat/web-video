<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Video Form</title>
</head>
<body>
    <h1>Add Video</h1>
    <form action="add_video.php" method="POST">
        <label for="videoName">Video Name:</label><br>
        <input type="text" id="videoName" name="videoName"><br><br>
        
        <label for="videoId">Video ID (Google Drive):</label><br>
        <input type="text" id="videoId" name="videoId"><br><br>
        
        <label for="videoDescription">Video Description:</label><br>
        <textarea id="videoDescription" name="videoDescription" rows="4" cols="50"></textarea><br><br>

        <label for="videoType">Video Type:</label>
        <select id="videoType" name="videoType">
            <option value="Tutorial">Tutorial</option>
            <option value="Entertainment">Entertainment</option>
            <option value="Documentary">Documentary</option>
            <!-- Add more options as needed -->
        </select><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
