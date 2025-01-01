<?php require_once 'db-connection.php';?>
<html>
    <head>
        <title>Seller Page</title>
        <link rel="stylesheet" href="sellerpagecss.css">
        <link rel="icon" type="image/x-icon" href="icon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    </head>
    <Body>
        <div class="container">
        <a href="sellerpage.php">
            <img class="logo" src="logobg.png" alt="Logo" height="120" width="160"></a>
            <div class="navbar" id="myNavbar">
    
            <?php
session_start();

// Database connection
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
<div id="userInfoContainer" style="display: none;"></div> <!-- Container to display user info -->

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Listen for click event on login button
    var loginBtn = document.querySelector('.login');
    loginBtn.addEventListener('click', function() {
        var userInfoContainer = document.getElementById('userInfoContainer');
        var username = loginBtn.getAttribute('data-username');
        var email = loginBtn.getAttribute('data-email');
        
        // Display user information in the container
        userInfoContainer.innerHTML = '<p>Username: ' + username + '</p><p>Email: ' + email + '</p>';
        userInfoContainer.style.display = 'block';

        // Position the container below the button and horizontally align it with the button's center
        var buttonRect = loginBtn.getBoundingClientRect();
        userInfoContainer.style.top = (buttonRect.bottom + window.scrollY) + 'px'; // Position below the button
        userInfoContainer.style.left = (buttonRect.left + (buttonRect.width / 2) - (userInfoContainer.offsetWidth / 2)) + 'px'; // Horizontally align with button center
    });
});

</script>
</div>

        </div>
        <div class="button-container">
            <a href="sellerbooksedit.php"><button>Edit Books info</button></a>
           <a href="booksadd.php"><button>Add Books</button></a>
           <a href="orders.php"><button>Check Orders</button></a>
        
        </div>
    
    </Body>
</html>