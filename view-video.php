<?php
include 'connection.php';

// Search filter
$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$query = "SELECT * FROM videos";
if ($search) {
    $query .= " WHERE name LIKE '%$search%'";
}
$query .= " ORDER BY id DESC";
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>View Videos</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input {
            padding: 8px;
            width: 50%;
            max-width: 400px;
            border: none;
            border-radius: 5px;
        }
        .search-container button {
            padding: 8px 15px;
            background-color: #ff9800;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .video-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 16px; /* Space between items */
            justify-content: flex-start; /* Aligns items from the start */
        }
        .video-card {
            width: 320px; /* Fixed width for each card */
            background: #1e1e1e;
            padding: 10px;
            border-radius: 8px;
            text-align: left;
            flex-shrink: 0; /* Prevents shrinking */
        }
        .video-card video {
            width: 100%;
            border-radius: 5px;
         }
        .video-card h3 {
            margin: 10px 0 5px;
            font-size: 18px;
        }
        .video-card p {
            font-size: 14px;
            color: #bbb;
        }
        .edit-delete {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            background: #ff5722;
            color: white;
            text-decoration: none;
            border-radius: 4px;
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
    <h2>Uploaded Videos</h2>

    <div class="search-container">
        <form method="GET">
            <input type="text" name="search" placeholder="Search videos..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <div class="video-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="video-card">
                <video controls>
                    <source src="<?php echo $row['file_path']; ?>" type="video/mp4">
                </video>
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <a href="edit-delete.php?id=<?php echo $row['id']; ?>" class="edit-delete">Edit/Delete</a>
            </div>
        <?php endwhile; ?>
    </div>

</body>
</html>
