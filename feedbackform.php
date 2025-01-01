<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $feedback = $_POST['feedback'];
    $status = 'received';

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO feedbacks (username, feedbacks, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $feedback, $status);

    if ($stmt->execute()) {
        header('Location: welcome.php?feedback=success'); // Redirect with success message
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: welcome.php'); // Redirect to user page if not POST request
    exit();
}
?>
