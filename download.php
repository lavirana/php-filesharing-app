<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $result = $conn->query("SELECT * FROM files WHERE id=$id");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $filepath = $row['filepath'];
        $filename = $row['filename'];

        if (file_exists($filepath)) {
            // last download update
            $conn->query("UPDATE files SET last_download_at = NOW() WHERE id=$id");

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } else {
            echo "File not found!";
        }
    } else {
        echo "Invalid file!";
    }
}
?>
