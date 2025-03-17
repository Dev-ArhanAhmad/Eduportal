<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $targetDir = "uploads/";

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES['video']['name']);
    $targetFilePath = $targetDir . $fileName;

    $allowedTypes = ['video/mp4', 'video/avi', 'video/mov'];
    if (in_array($_FILES['video']['type'], $allowedTypes)) {
        if (move_uploaded_file($_FILES['video']['tmp_name'], $targetFilePath)) {
            $stmt = $con->prepare("INSERT INTO videos (name, description, file_path) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $description, $targetFilePath);
            $stmt->execute();
            header("Location: upload-video.php");
            exit;
        } else {
            echo "<p class='error'>Error: Video upload failed.</p>";
        }
    } else {
        // echo "<p class='error'>Error: Invalid file format.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Upload Video</title>
    <style>
        body {
            background-color: #181818;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .upload-container {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #555;
            background: #333;
            color: white;
            outline: none;
        }
        textarea {
            resize: none;
            height: 80px;
        }
        .file-input {
            background: #333;
            padding: 10px;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            background: #ff0000;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #cc0000;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        .back-icon {
            position: fixed;
            top: 6px;
            left: 20px;
            font-size: 24px;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            padding: 10px;
            border-radius: 50%;
            text-align: center;
            transition: background 0.3s ease-in-out;
        }

        .back-icon:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <a href="admindashboard.php" class="back-icon">
        <i class="fas fa-arrow-left"></i>
    </a>

<div class="upload-container">
    <h2>Upload a Video</h2>

    <form method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <label>Video Name:</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label>Description:</label>
            <textarea name="description" required></textarea>
        </div>

        <div class="input-group">
            <label>Choose Video:</label>
            <input type="file" name="video" accept="video/*" class="file-input" required>
        </div>

        <button type="submit">Upload Video</button>
    </form>
</div>

</body>
</html>
