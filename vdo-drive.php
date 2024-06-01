<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูวิดีโอ</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 */
            height: 0;
            overflow: hidden;
            max-width: 100%;
            background: #000;
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 20px;
        }

        .video-item {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>เว็บไซต์วิดีโอ</h1>
        <nav>
            <ul>
                <li><a href="index.php">หน้าหลัก</a></li>
                <li><a href="upload.php">อัปโหลด</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        if (isset($_GET['id'])) {
            include 'db.php';
            $videoId = $_GET['id'];
            $sql = "SELECT file_name, description, upload_date FROM videos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $videoId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $fileId = $row["file_name"]; // Assuming file_name stores the Google Drive file ID
                $videoUrl = "https://drive.google.com/file/d/$fileId/preview";
                $description = $row["description"];
                $uploadDate = $row["upload_date"];
                echo "<div class='video-item'>
                        <div class='video-container'>
                            <iframe src='$videoUrl' allow='autoplay'></iframe>
                        </div>
                        <p>$description</p>
                        <p><small>อัปโหลดเมื่อ: $uploadDate</small></p>
                      </div>";
            } else {
                echo "<p>ไม่พบวิดีโอ</p>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<p>ไม่ได้ระบุวิดีโอ</p>";
        }
        ?>
    </main>
</body>
</html>
