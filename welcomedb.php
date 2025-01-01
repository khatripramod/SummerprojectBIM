<?php
session_start(); // Start the session if not already started

// Database connection
$conn = mysqli_connect("localhost", "root", "", "books", 3306);

// Check if user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // You can use $username wherever you need to display the username
    echo '<button class="login">' . $username . '</button>';
} else {
    // If user is not logged in, handle it accordingly
    echo '<button class="login">Login</button>';
}
?>
