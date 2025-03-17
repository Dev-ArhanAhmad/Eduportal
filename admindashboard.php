<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: #1e1e1e;
            position: fixed;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
            color: #03dac6;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 10px 0;
            background: #333;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background: #03dac6;
        }
        .logout {
            background: red;
            text-align: center;
        }

        /* Dashboard Content */
        .content {
            margin-left: 270px;
            padding: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            color: white;
            font-size: 18px;
        }

        .card:nth-child(1) { background: #03a9f4; }
        .card:nth-child(2) { background: #ff9800; }
        .card:nth-child(3) { background: #f44336; }
        .card:nth-child(4) { background: #4caf50; }
        .card:nth-child(5) { background: #2196f3; }
        .card:nth-child(6) { background: #e91e63; }
        .card:nth-child(7) { background: #009688; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="#">Dashboard</a>
    <a href="admission-display.php" >Online Admission</a>
    <a href="view-video.php">Courses</a>
    <a href="upload-video.php">Add New Course</a>
    <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Content -->
<div class="content">
    <h1>Welcome, <?php echo($_SESSION['name']); ?>!</h1>
    <p>EduPortal Admin Panel | Manage Students & Courses</p>

    <div class="cards">
        <div class="card">16<br> Total Pages</div>
        <div class="card">4 <br> Total Sliders</div>
        <div class="card">6 <br> Total Team</div>
        <div class="card">3 <br> Total Services</div>
    </div>
</div>

</body>
</html>
