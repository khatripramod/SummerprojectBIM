<?php
$conn = mysqli_connect("localhost","root","","books",3306);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username; // Store the username in a session variable
                header('Location: welcome.php'); 
                exit(); 
            } else {
                $errorMessage = "Incorrect username or password";
            }
        } else {
            $errorMessage = "Incorrect username or password";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>