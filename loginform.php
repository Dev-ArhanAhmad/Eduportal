<?php
session_start();
if (isset($_SESSION['user_name'])) {
    header("Location: admindashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Dark background */
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form {
            background-color: #1E1E1E; /* Dark modal background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .error {
            color: #ff4d4d;
            background-color: #2E2E2E;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: white;
        }

        input::placeholder {
            color: #bbb;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
    <a href="index.html" class="back-icon">
        <i class="fas fa-arrow-left"></i>
    </a>  

<div class="login-form">
    <h2>Login</h2>
    
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo ($_GET['error']); ?></p>
    <?php } ?>

    <form action="login.php" method="POST">
        <input type="text" name="uname" placeholder="Enter username" required>
        <input type="password" name="password" placeholder="Enter password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
