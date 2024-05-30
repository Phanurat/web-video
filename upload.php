<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['videoFile']) && isset($_POST['description'])) {
        $targetDir = "uploads/videos/";
        $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]);
        $uploadOk = 1;
        $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $description = $_POST['description'];

        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["videoFile"]["size"] > 50000000) { // 50MB limit
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($videoFileType != "mp4" && $videoFileType != "webm") {
            echo "Sorry, only MP4 & WEBM files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
                // บันทึกรายละเอียดในฐานข้อมูล
                $stmt = $conn->prepare("INSERT INTO videos (file_name, description) VALUES (?, ?)");
                $stmt->bind_param("ss", basename($_FILES["videoFile"]["name"]), $description);
                $stmt->execute();
                $stmt->close();

                echo "The file ". htmlspecialchars(basename($_FILES["videoFile"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file or description received.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
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
        <h2>Upload a Video</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select video to upload:
            <input type="file" name="videoFile" id="videoFile"><br><br>
            Description:
            <textarea name="description" id="description" rows="4" cols="50"></textarea><br><br>
            <input type="submit" value="Upload Video" name="submit">
        </form>
    </main>

    <script src="js/script.js"></script>
</body>
</html>
