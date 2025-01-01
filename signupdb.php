<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission
    $type = $_POST['costumer']; // Assuming 'costumer' represents the type of user
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $gender = $_POST['gender'];
    $phoneCode = $_POST['phoneCode'];
    $phoneNumber = $_POST['phone'];
    $email = $_POST['email'];
    $addresss= $_POST['address'];

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "Username already taken. Please choose a different username.";
        exit; // Stop further execution
    }

    // Insert data into the users table
    $user_query = "INSERT INTO users (full_name, types, username, password, gender, phone_number, email, address, created_at, updated_at) 
              VALUES ('$fullname', '$type', '$username', '$password', '$gender', '$phoneCode$phoneNumber', '$email','$addresss', NOW(), NOW())";
    
    // Execute the user insertion query
    $user_result = mysqli_query($conn, $user_query);
    
    if (!$user_result) {
        echo "Error: " . mysqli_error($conn);
    }
    if ($type == 'Customer') {
        $customer_query = "INSERT INTO customers (full_name, username, password, email,gender, phone_number,address, created_at, updated_at) 
        VALUES ('$fullname', '$username', '$password', '$email', '$gender', '$phoneCode$phoneNumber','$addresss', NOW(), NOW())";
        mysqli_query($conn, $customer_query);
    } elseif ($type == 'Seller') {
        $seller_query = "INSERT INTO sellers (full_name,  username, password, email, gender, phone_number, address, created_at, updated_at) 
        VALUES ('$fullname',  '$username', '$password',  '$email', '$gender', '$phoneCode$phoneNumber','$addresss', NOW(), NOW())";
        mysqli_query($conn, $seller_query);
    }

    if ($user_result && ($type == 'Customer' || $type == 'Seller')) {
        // Redirect to signup.php with a success parameter
        header("Location: signup.php?success=true");
        exit;
    }
} 

// Close the database connection
mysqli_close($conn);
?>