<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูวิดีโอจาก Google Drive</title>
    <link rel="stylesheet" href="https://vjs.zencdn.net/8.10.0/video-js.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* เพิ่ม CSS เพื่อทำให้หน้าเว็บไซต์เป็น responsive */
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

        @media screen and (max-width: 768px) {
            .video-item iframe {
                width: 100%;
                height: auto;
            }
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
            $sql = "SELECT video_name, google_drive_id, description, video_type FROM videos_drive WHERE google_drive_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $videoId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $videoName = $row["video_name"];
                $googleDriveId = $row["google_drive_id"];
                $description = $row["description"];
                $videoType = $row["video_type"];
                echo "<div class='video-item'>
                        <iframe src='https://drive.google.com/file/d/$googleDriveId/preview' width='640' height='480' allow='autoplay'></iframe>
                        <p>$description</p>
                        <p><small>ประเภทวิดีโอ: $videoType</small></p>
                      </div>";
            } else {
                echo "ไม่พบวิดีโอ";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "ไม่ได้ระบุวิดีโอ";
        }
        ?>
    </main>

    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
