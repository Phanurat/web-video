<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูวิดีโอ</title>
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
            .video-item video {
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
            $sql = "SELECT file_name, description, upload_date FROM videos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $videoId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $video = "uploads/videos/" . $row["file_name"];
                $description = $row["description"];
                $uploadDate = $row["upload_date"];
                echo "<div class='video-item'>
                        <video id='my-video' class='video-js' controls preload='auto' width='640' height='480' poster='MY_VIDEO_POSTER.jpg' data-setup='{}'>
                            <source src='$video' type='video/mp4'>
                            <source src='$video' type='video/webm'>
                            เบราว์เซอร์ของคุณไม่รองรับแท็กวิดีโอ
                        </video>
                        <p>$description</p>
                        <p><small>อัปโหลดเมื่อ: $uploadDate</small></p>
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