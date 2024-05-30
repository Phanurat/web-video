<?php
$servername = "localhost";
$username = "root"; // ปรับให้ตรงกับชื่อผู้ใช้ของคุณ
$password = ""; // ปรับให้ตรงกับรหัสผ่านของคุณ
$dbname = "video_website";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
