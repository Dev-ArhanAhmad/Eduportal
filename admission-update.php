<?php 
include 'connection.php'; 

// Check if ID is set in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid ID'); window.location='Display.php';</script>";
    exit;
}

$id = $_GET['id'];

// Fetch Data
$select = "SELECT * FROM student WHERE id='$id' ";
$data = mysqli_query($con, $select);
$row = mysqli_fetch_array($data);

if (!$row) {
    echo "<script>alert('Record not found'); window.location='Display.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .container {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 255, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #00ff00;
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: #2c2c2c;
            color: white;
        }

        input::placeholder {
            color: #bbb;
        }

        button, input[type="submit"] {
            width: 100%;
            background: #00ff00;
            color: black;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
        }

        button:hover, input[type="submit"]:hover {
            background: #00cc00;
        }

        .back-btn {
            background: red;
            color: white;
            margin-top: 15px;
        }

        .back-btn:hover {
            background: darkred;
        }

        .back-btn a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Student</h2>
        <form action="" method="post">
            <input value="<?php echo ($row['firstname']); ?>" type="text" name="firstname" placeholder="Firstname" required><br>
            <input value="<?php echo ($row['lastname']); ?>" type="text" name="lastname" placeholder="Lastname" required><br>
            <input value="<?php echo ($row['email']); ?>" type="email" name="email" placeholder="Email" required><br>
            <input value="<?php echo ($row['contact']); ?>" type="text" name="contact" placeholder="Contact Number" required><br>

            <select name="course" required>
                <option value="Computer Science" <?php if ($row['course'] == "Computer Science") echo "selected"; ?>>Computer Science</option>
                <option value="Electrical Engineering" <?php if ($row['course'] == "Electrical Engineering") echo "selected"; ?>>Electrical Engineering</option>
                <option value="Mechanical Engineering" <?php if ($row['course'] == "Mechanical Engineering") echo "selected"; ?>>Mechanical Engineering</option>
            </select>

            <input type="submit" name="update_btn" value="Update Student">
        </form>

        <!-- Back Button -->
        <button class="back-btn"><a href="Display.php">⬅ Go Back</a></button>
    </div>

    <?php
    if (isset($_POST['update_btn'])) {
        $fname = trim($_POST['firstname']);
        $lname = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $contact = trim($_POST['contact']);
        $course = trim($_POST['course']);

        // Ensure fields are not empty
        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($contact) && !empty($course)) {
            $update = "UPDATE student SET 
                       firstname='$fname', 
                       lastname='$lname', 
                       email='$email', 
                       contact='$contact', 
                       course='$course' 
                       WHERE id='$id'";

            $data = mysqli_query($con, $update);

            if ($data) {
                echo "<script>alert('Data Successfully Updated'); window.location='Display.php';</script>";
            } else {
                echo "<script>alert('Error! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('All fields are required.');</script>";
        }
    }
    ?>

</body>
</html>
