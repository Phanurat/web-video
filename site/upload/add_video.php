<?php
// Include the database configuration file
include '../../db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are filled
    if (isset($_POST['videoName']) && isset($_POST['videoId']) && isset($_POST['videoDescription']) && isset($_POST['videoType'])) {
        // Retrieve and sanitize form data
        $videoName = htmlspecialchars($_POST['videoName']);
        $videoId = htmlspecialchars($_POST['videoId']);
        $videoDescription = htmlspecialchars($_POST['videoDescription']);
        $videoType = htmlspecialchars($_POST['videoType']);

        // Prepare and execute SQL query to insert data into the database
        $sql = "INSERT INTO videos_drive (video_name, google_drive_id, description, video_type) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $videoName, $videoId, $videoDescription, $videoType);
        
        if ($stmt->execute()) {
            // If insertion is successful, redirect back to the form page with success message
            header("Location: upload-form.php?success=1");
            exit();
        } else {
            // If insertion fails, redirect back to the form page with error message
            header("Location: upload-form.php?error=1");
            exit();
        }
    } else {
        // If not all form fields are filled, redirect back to the form page with error message
        header("Location: add_video_form.php?error=2");
        exit();
    }
} else {
    // If form is not submitted, redirect back to the form page
    header("Location: add_video_form.php");
    exit();
}
?>
