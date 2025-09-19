<?php
include 'config.php';

$fileExpireDays = 30; // files inactivity
$videoExpireDays = 15; // videos inactivity

// delete inactive files
$sql = "SELECT * FROM files";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $filetype = $row['filetype'];
    $filepath = $row['filepath'];

    $lastActivity = $row['last_download_at'] ?? $row['last_played_at'] ?? $row['uploaded_at'];

    $expireDays = (strpos($filetype, 'video') !== false) ? $videoExpireDays : $fileExpireDays;

    $expireDate = strtotime($lastActivity . " +$expireDays days");
    if (time() > $expireDate) {
        if (file_exists($filepath)) {
            unlink($filepath); // delete file
        }
        $conn->query("DELETE FROM files WHERE id=$id");
        echo "Deleted: " . $row['filename'] . "<br>";
    }
}
?>
