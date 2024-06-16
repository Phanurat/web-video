<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูวิดีโอจาก Google Drive</title>
    <link rel="stylesheet" href="https://vjs.zencdn.net/8.10.0/video-js.css">
    <style>
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

        #ad-container {
            position: relative;
            display: none;
        }

        #ad-container video {
            width: 100%;
            height: auto;
        }

        #skip-button {
            position: absolute;
            bottom: 10px; /* ตำแหน่งด้านล่างของวิดีโอ */
            right: 10px; /* ตำแหน่งด้านขวาของวิดีโอ */
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            display: none; /* ซ่อนปุ่มในตอนแรก */
        }

        #countdown {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            padding: 5px 10px;
            border: none;
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
        <div id="ad-container">
            <video id="ad-video" class="video-js" controls preload="auto">
                <source src="ads-video/ads.mp4" type="video/mp4">
                เบราว์เซอร์ของคุณไม่รองรับการเล่นวิดีโอ
            </video>
            <button id="skip-button">ข้ามโฆษณา</button>
            <div id="countdown">ข้ามได้ใน 3 วินาที</div>
        </div>

        <div id="main-video-container" style="display:none;">
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
                            <iframe id='main-video' src='https://drive.google.com/file/d/$googleDriveId/preview' width='640' height='480' allow='autoplay'></iframe>
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
        </div>
    </main>

    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const adContainer = document.getElementById('ad-container');
            const adVideo = videojs('ad-video');
            const skipButton = document.getElementById('skip-button');
            const mainVideoContainer = document.getElementById('main-video-container');
            const countdown = document.getElementById('countdown');

            adContainer.style.display = 'block';

            let countdownTimer = 3;

            adVideo.on('play', () => {
                const countdownInterval = setInterval(() => {
                    countdownTimer--;
                    countdown.textContent = `ข้ามได้ใน ${countdownTimer} วินาที`;

                    if (countdownTimer <= 0) {
                        clearInterval(countdownInterval);
                        skipButton.style.display = 'block';
                        countdown.style.display = 'none';
                    }
                }, 1000);
            });

            skipButton.addEventListener('click', () => {
                adVideo.pause();
                adContainer.style.display = 'none';
                mainVideoContainer.style.display = 'block';
            });

            adVideo.on('ended', () => {
                adContainer.style.display = 'none';
                mainVideoContainer.style.display = 'block';
            });
        });
    </script>
</body>
</html>
