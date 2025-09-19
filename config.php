<?php
$host = 'localhost';
$user = "root";   // apna DB user
$pass = "root";       // apna DB password
$db   = "filesharing";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
