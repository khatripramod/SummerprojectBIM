<html>
<head>
    <title>SWAGATAM</title>
    <link rel="stylesheet" href="user.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        .account-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .account-details {
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
        }

        .account-info {
            margin-right: 20px;
        }

        .user-icon {
            font-size: 48px;
            color: #555;
            margin-right: 20px;
        }

        #updateButton {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #updateForm {
            display: none;
            background-color: #f0f0f0;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        #updateForm input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="welcome.php">
                    <img src="image.png" alt="Logo">
                </a>
            </div>
        </nav>
    </header>

    <?php
    // Start the session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['username'])) {
        // Redirect the user to the login page
        header("Location: login.php");
        exit;
    }

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "books", 3306);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the user's information from the database
    $username = $_SESSION['username'];
    $query = "SELECT * FROM customers WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    ?>

    <div class="account-container">
        <div class="account-details">
            <div class="account-info">
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
                <?php
                if (isset($_GET['update']) && $_GET['update'] == 'success') {
                    echo '<p class="success-message">User information updated successfully!</p>';
                }
                ?>
            </div>
            <i class="fas fa-user user-icon"></i>
            <button id="updateButton">Update Information</button>
        </div>
    </div>

    <div id="updateForm">
        <h3>Update Information</h3>
        <form method="POST" action="update_user.php">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['address']); ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>

    <script>
        const updateButton = document.getElementById('updateButton');
        const updateForm = document.getElementById('updateForm');

        updateButton.addEventListener('click', () => {
            updateForm.style.display = updateForm.style.display === 'none' ? 'block' : 'none';
        });
    </script>
</body>
</html>
