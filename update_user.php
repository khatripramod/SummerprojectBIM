<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit;
}

// Database connection
$conn = mysqli_connect("localhost", "root", "", "books", 3306);

// Check connection
if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if necessary POST variables are set
    if (isset($_POST["username"]) && isset($_POST["full_name"]) && isset($_POST["email"]) && isset($_POST["phone_number"]) && isset($_POST["address"])) {
        // Get the form data
        $username = $_POST["username"];
        $fullname = $_POST["full_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone_number"];
        $address = $_POST["address"];

        // Debug: Log the received data
        error_log("Received data: username=$username, full_name=$fullname, email=$email, phone_number=$phone, address=$address");

        // Prepare an update statement
        $sql = "UPDATE customers SET full_name = ?, email = ?, phone_number = ?, address = ? WHERE username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $fullname, $email, $phone, $address, $username);
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect back to myaccount.php with a success message
                header("Location: myaccount.php?update=success");
                exit();
            } else {
                // Log execution error
                error_log("Error executing statement: " . mysqli_stmt_error($stmt));
                echo "Error updating user information: " . mysqli_stmt_error($stmt);
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            // Log preparation error
            error_log("Error preparing the update statement: " . mysqli_error($conn));
            echo "Error preparing the update statement: " . mysqli_error($conn);
        }
    } else {
        // Log missing data
        error_log("Required data not provided.");
        echo "Required data not provided.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
