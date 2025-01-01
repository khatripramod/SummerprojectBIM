<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);

// Check if user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query to fetch user information based on username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Check if query was successful
    if ($result) {
        // Fetch user information
        $user = mysqli_fetch_assoc($result);

        // Display button with user information as data attributes
        echo '<button class="login" data-username="' . $user['username'] . '" data-email="' . $user['email'] . '"><i class="fas fa-user"></i> ' . $username . '</button>';
    } else {
        echo '<button class="login">Login</button>'; // If error occurs, display regular login button
    }
} else {
    echo '<button class="login">Login</button>';
}
?>