<!DOCTYPE html>
<html>
<head>
    <title>SWAGATAM</title>
    <link rel="stylesheet" href="booksadmin.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .container {
            text-align: center;
            margin: 20px;
        }

        .logo {
            width: 150px;
        }

        .center {
            text-align: center;
            margin: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin.php">
            <img class="logo" src="image.png">
        </a>
    </div>
    <div class="center">
        <h1>Welcome to Feedback Page</h1>
    </div>

    <?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "books", 3306);

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    // Fetch feedback data
    $sql = "SELECT username, feedbacks, status, created_at, updated_at FROM feedbacks";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Username</th>';
        echo '<th>Feedback</th>';
        echo '<th>Status</th>';
        echo '<th>Created At</th>';
        echo '<th>Updated At</th>';
        echo '</tr>';

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['username']) . '</td>';
            echo '<td>' . htmlspecialchars($row['feedbacks']) . '</td>';
            echo '<td>' . htmlspecialchars($row['status']) . '</td>';
            echo '<td>' . htmlspecialchars($row['created_at']) . '</td>';
            echo '<td>' . htmlspecialchars($row['updated_at']) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p class="center">No feedbacks found.</p>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
