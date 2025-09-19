CREATE DATABASE filesharing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE filesharing;

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    filepath VARCHAR(255) NOT NULL,
    filetype VARCHAR(50) NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_download_at TIMESTAMP NULL,
    last_played_at TIMESTAMP NULL
);
