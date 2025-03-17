<?php
include 'connection.php';

$id = $_GET['id'] ?? 0;

// Fetch video details
$stmt = $con->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Error: Video not found.");
}

// Handle form submission
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $videoPath = $row['file_path'];

    // Check if a new video is uploaded
    if (!empty($_FILES['new_video']['name'])) {
        $targetDir = "uploads/";
        $newVideoPath = $targetDir . basename($_FILES["new_video"]["name"]);

        // Move the new video file
        if (move_uploaded_file($_FILES["new_video"]["tmp_name"], $newVideoPath)) {
            // Delete old video
            if (file_exists($videoPath)) {
                unlink($videoPath);
            }
            $videoPath = $newVideoPath;
        }
    }

    // Update video details in the database
    $stmt = $con->prepare("UPDATE videos SET name=?, description=?, file_path=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $description, $videoPath, $id);
    $stmt->execute();
    header("Location: view-video.php");
    exit;
}

// Handle video deletion
if (isset($_POST['delete'])) {
    if (file_exists($row['file_path'])) {
        unlink($row['file_path']);
    }
    $stmt = $con->prepare("DELETE FROM videos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: view-video.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Video</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 8px;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea, button {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }
        input, textarea {
            background: #333;
            color: white;
        }
        button {
            background-color: #ff9800;
            color: white;
            cursor: pointer;
        }
        .delete-btn {
            background-color: #d32f2f;
        }
        .back-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
            background: #555;
            padding: 10px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
        video {
            width: 100%;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h2>Edit Video</h2>

    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <label>Current Video:</label>
            <video controls>
                <source src="<?php echo $row['file_path']; ?>" type="video/mp4">
            </video>

            <label>Replace Video:</label>
            <input type="file" name="new_video" accept="video/*">

            <label>Video Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

            <label>Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($row['description']); ?></textarea>

            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete" class="delete-btn">Delete</button>
            <a href="view-video.php" class="back-btn">⬅ Back to Videos</a>
        </form>
    </div>


</body>
</html>
