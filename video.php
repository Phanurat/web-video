<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูวิดีโอ</title>
    <link rel="stylesheet" href="css/styles.css">
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
                        <video width='640' height='480' controls>
                            <source src='$video' type='video/mp4'>
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

    <script src="js/script.js"></script>
</body>
</html>
