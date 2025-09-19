<?php
include 'config.php';

$status = "";
$message = "";

if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    $fileTmp  = $_FILES['file']['tmp_name'];
    $fileType = $_FILES['file']['type'];

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . time() . "_" . basename($fileName);

    if (move_uploaded_file($fileTmp, $filePath)) {
        $stmt = $conn->prepare("INSERT INTO files (filename, filepath, filetype) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fileName, $filePath, $fileType);
        $stmt->execute();
        $stmt->close();

        $status = "success";
        $message = "File uploaded successfully!";
    } else {
        $status = "error";
        $message = "Upload failed! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Status</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow-lg border-0 text-center" style="max-width: 500px; width: 100%;">
    <div class="card-body">
      <?php if ($status === "success"): ?>
        <div class="mb-3" style="font-size: 2rem;">✅</div>
        <h3 class="text-success"><?= $message ?></h3>
        <p class="text-muted">Your file has been uploaded and is now available for sharing.</p>
        <a href="index.php" class="btn btn-primary mt-3">⬅ Go Back</a>
      <?php else: ?>
        <div class="mb-3" style="font-size: 2rem;">❌</div>
        <h3 class="text-danger"><?= $message ?></h3>
        <a href="index.php" class="btn btn-secondary mt-3">⬅ Try Again</a>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
