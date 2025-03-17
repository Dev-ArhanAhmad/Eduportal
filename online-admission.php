<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Student Registration</title>
    <style>
        /* Dark Theme Styles */
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
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #00ff00;
            margin-bottom: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
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

        button a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        button:hover, input[type="submit"]:hover {
            background: #00cc00;
        }

        .back-icon {
          position: fixed;
          top: 20px;
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
<a href="index.html" class="back-icon">
    <i class="fas fa-arrow-left"></i>
</a>
    <div class="container">
        <h2>Student Registration</h2>
        <form action="" method="post">
            <input type="text" name="firstname" placeholder="Firstname" required><br>
            <input type="text" name="lastname" placeholder="Lastname" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="contact" placeholder="Contact Number" required><br>

            <select name="course" required>
                <option value="">Select Course</option>
                <option value="Computer Science">E-Commerce & Digital Marketing</option>
                <option value="Computer Science">Data Science & Machine Learning</option>
                <option value="Computer Science">Cybersecurity & Ethical Hacking</option>
                <option value="Computer Science">Web Development (Full-Stack) </option>
                <option value="Computer Science">Cloud Computing & DevOps</option>
            </select>
            <input type="submit" name="save_btn" value="Register Student">
        </form>
    </div>

    <?php
        if (isset($_POST['save_btn'])) {
            $fname = trim($_POST['firstname']);
            $lname = trim($_POST['lastname']);
            $email = trim($_POST['email']);
            $contact = trim($_POST['contact']);
            $course = trim($_POST['course']);
        
            if (!empty($fname) && !empty($lname) && !empty($email) && !empty($contact) && !empty($course)) {
                $query = "INSERT INTO student (firstname, lastname, email, contact, course) 
                          VALUES ('$fname', '$lname', '$email', '$contact', '$course')";
                $data = mysqli_query($con, $query);
        
                if ($data) {
                    echo "<script>alert('Data Successfully Inserted'); </script>";
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
