<?php
// Include the database configuration file
include '../../db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $videoName = $_POST['videoName'];
    $videoId = $_POST['videoId'];
    $videoDescription = $_POST['videoDescription'];
    $videoType = $_POST['videoType'];

    // Prepare and execute SQL query to insert data into the database
    $sql = "INSERT INTO videos_drive (video_name, google_drive_id, description, video_type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $videoName, $videoId, $videoDescription, $videoType);
    
    if ($stmt->execute()) {
        // If insertion is successful, redirect back to the form page with success message
        header("Location: add_video_form.php?success=1");
        exit();
    } else {
        // If insertion fails, redirect back to the form page with error message
        header("Location: add_video_form.php?error=1");
        exit();
    }
} else {
    // If form is not submitted, redirect back to the form page
    header("Location: add_video_form.php");
    exit();
}
?>
