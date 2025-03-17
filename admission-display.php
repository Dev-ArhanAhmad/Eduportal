<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Student Records</title>
    <style>
        /* Dark Theme Styling */
        body {
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h2 {
            color: #00ff00;
            margin-bottom: 15px;
        }

        .container {
            width: 80%;
            margin: auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 255, 0, 0.3);
        }

        /* Search Box */
        .search-box {
            margin-bottom: 20px;
        }

        input[type="text"] {
            width: 70%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #2c2c2c;
            color: white;
            outline: none;
        }

        input[type="submit"] {
            padding: 10px 15px;
            background: #00ff00;
            border: none;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #00cc00;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #2c2c2c;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #444;
            text-align: center;
        }

        th {
            background: #00ff00;
            color: black;
        }

        tr:nth-child(even) {
            background: #1a1a1a;
        }

        /* Action Buttons */
        .edit-btn, .delete-btn {
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .edit-btn {
            background: #ffcc00;
            color: black;
        }

        .edit-btn:hover {
            background: #e6b800;
        }

        .delete-btn {
            background: red;
            color: white;
        }

        .delete-btn:hover {
            background: darkred;
        }

        /* Back Button */
        .back-btn {
            background: red;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .back-btn:hover {
            background: darkred;
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

    <div class="container">
        <h2>Student Records</h2>

        <!-- Search Form -->
        <form method="GET" action="Display.php" class="search-box">
            <input type="text" name="search" placeholder="Search by First Name, Last Name, or Email">
            <input type="submit" value="Search">
        </form>

        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Course</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
            // Check if the search query exists
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                // Use LIKE to match the search string in first name, last name, or email
                $query = "SELECT * FROM student WHERE firstname LIKE '%$search%' 
                          OR lastname LIKE '%$search%' OR email LIKE '%$search%'";
            } else {
                // Default query when no search is made
                $query = "SELECT * FROM student";
            }

            // Execute the query
            $data = mysqli_query($con, $query);
            $result = mysqli_num_rows($data);

            if ($result) {
                // Display data if records are found
                while ($row = mysqli_fetch_array($data)) {
                ?>
                <tr>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['course']; ?></td>

                    <td>
                        <a href="admission-update.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                    </td>

                    <td>
                        <a onclick="return confirm('Are you sure you want to delete?')" 
                        href="admission-delete.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                    </td>
                </tr>
                <?php
                }
            } else {
                // Display message if no records are found
                ?>
                <tr>
                    <td colspan="7">No records found</td>
                </tr>
                <?php
            }
            ?>
        </table>
         
    </div>

</body>
</html>
