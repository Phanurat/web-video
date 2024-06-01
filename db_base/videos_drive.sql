CREATE TABLE videos_drive (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video_name VARCHAR(255) NOT NULL,
    google_drive_id VARCHAR(255) NOT NULL,
    description TEXT,
    video_type ENUM('Tutorial', 'Entertainment', 'Documentary', 'Other') NOT NULL
);
