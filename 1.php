<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitab.com</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .column {
            display: flex;
            flex-direction: column;
        }

        .sidebar {
            background-color: #f1f1f1;
            padding: 15px;
            width: 200px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="column">
        <div class="sidebar">
            <?php
            // Replace these values with your actual database credentials
            $host = "your_database_host";
            $username = "your_database_username";
            $password = "your_database_password";
            $database = "student";

            // Create a connection
            $conn = new mysqli($host, $username, $password, $database);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch and display links from the database
            $query = "SELECT * FROM your_table_name"; // Replace your_table_name with the actual table name
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<a href="#">' . $row["link_name_column"] . '</a>';
                }
            } else {
                echo "No links found in the database.";
            }

            // Close the connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
