<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username from the form
    $username = $_POST['username'];

    // Query to fetch user data based on the username
    $userQuery = "SELECT * FROM users WHERE username = ?";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param("s", $username);
    $userStmt->execute();
    $userResult = $userStmt->get_result();
    $userRow = $userResult->fetch_assoc();

    // Query to fetch customer data based on the username
    $customerQuery = "SELECT * FROM customers WHERE username = ?";
    $customerStmt = $conn->prepare($customerQuery);
    $customerStmt->bind_param("s", $username);
    $customerStmt->execute();
    $customerResult = $customerStmt->get_result();
    $customerRow = $customerResult->fetch_assoc();

    // Check if the user and customer exist
    if ($userResult->num_rows > 0 && $customerResult->num_rows > 0) {
        // Check if the update form is submitted
        if (isset($_POST['update'])) {
            // Get the updated values from the form
            $fullName = $_POST['full_name'];
            $types = $_POST['types'];
            $gender = $_POST['gender'];
            $phoneNumber = $_POST['phone_number'];
            $email = $_POST['email'];
            $addresss=$_POST['address'];

            // Query to update user data
            $updateUserQuery = "UPDATE users SET full_name = ?, types = ?, gender = ?, phone_number = ?, email = ?, address=? WHERE username = ?";
            $updateUserStmt = $conn->prepare($updateUserQuery);
            $updateUserStmt->bind_param("sssssss", $fullName, $types, $gender, $phoneNumber, $email, $addresss, $username);
            $updateUserStmt->execute();

            // Query to update customer data
            $updateCustomerQuery = "UPDATE customers SET full_name = ?, email = ?, gender = ?, phone_number = ?, address=? WHERE username = ?";
            $updateCustomerStmt = $conn->prepare($updateCustomerQuery);
            $updateCustomerStmt->bind_param("ssssss", $fullName,  $email, $gender, $phoneNumber, $addresss ,$username);
            $updateCustomerStmt->execute();

            // Redirect to the same page after updating
            header("Refresh:0");
        }

        // Check if the delete form is submitted
        if (isset($_POST['delete'])) {
            // Query to delete user data
            $deleteUserQuery = "DELETE FROM users WHERE username = ?";
            $deleteUserStmt = $conn->prepare($deleteUserQuery);
            $deleteUserStmt->bind_param("s", $username);
            $deleteUserStmt->execute();

            // Query to delete customer data
            $deleteCustomerQuery = "DELETE FROM customers WHERE username = ?";
            $deleteCustomerStmt = $conn->prepare($deleteCustomerQuery);
            $deleteCustomerStmt->bind_param("s", $username);
            $deleteCustomerStmt->execute();

            // Redirect to the same page after deleting
            header("Refresh:0");
        }
    } else {
        echo "User or customer not found.";
    }
}
?>