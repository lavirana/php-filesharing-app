<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>File Sharing App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">📂 File Sharing</span>
  </div>
</nav>

<div class="container">
  <div class="card shadow-sm mb-4">
    <div class="card-header">Upload File / Video</div>
    <div class="card-body">
      <form action="upload.php" method="post" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-8">
          <input type="file" name="file" class="form-control" required>
        </div>
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary w-100">Upload</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-header">Available Files</div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Filename</th>
            <th>Type</th>
            <th>Uploaded</th>
            <th>Last Activity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
        include 'config.php';
        $result = $conn->query("SELECT * FROM files ORDER BY uploaded_at DESC");
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $filename = $row['filename'];
            $filetype = $row['filetype'];
            $uploaded = $row['uploaded_at'];
            $lastActivity = $row['last_download_at'] ?? $row['last_played_at'] ?? '-';

            echo "<tr>";
            echo "<td>$filename</td>";
            echo "<td>$filetype</td>";
            echo "<td>$uploaded</td>";
            echo "<td>$lastActivity</td>";
            echo "<td>";
            if (strpos($filetype, 'video') !== false) {
                echo "<a href='play.php?id=$id' class='btn btn-sm btn-success'>▶ Play</a>";
            } else {
                echo "<a href='download.php?id=$id' class='btn btn-sm btn-primary'>⬇ Download</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
