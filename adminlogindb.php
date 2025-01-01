<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username' AND types = 'admin'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['username'] = $username;
                header('Location: admin.php');
                exit();
            } else {
                $errorMessage = "Incorrect username or password";
            }
        } else {
            $errorMessage = "Incorrect username or password";
        }
    } else {
        $errorMessage = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>