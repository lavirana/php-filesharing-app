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
            // update last played
            $conn->query("UPDATE files SET last_played_at = NOW() WHERE id=$id");
        } else {
            die("❌ File not found!");
        }
    } else {
        die("❌ Invalid file!");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Playing: <?php echo $filename; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<nav class="navbar navbar-dark bg-black">
  <div class="container-fluid">
    <a href="index.php" class="navbar-brand">⬅ Back</a>
    <span class="navbar-text">Now Playing</span>
  </div>
</nav>

<div class="container my-4">
  <div class="card shadow-lg bg-secondary">
    <div class="card-header">
      🎬 Playing: <strong><?php echo $filename; ?></strong>
    </div>
    <div class="card-body text-center">
  <video class="w-100 rounded shadow" height="480" controls autoplay muted>
      <source src="<?php echo $filepath; ?>" type="video/mp4">
      Your browser does not support the video tag.
  </video>
</div>
    <div class="card-footer text-center">
      <a href="download.php?id=<?php echo $id; ?>" class="btn btn-primary">⬇ Download</a>
      <a href="index.php" class="btn btn-light">⬅ Back to Home</a>
    </div>
  </div>
</div>

</body>
</html>
