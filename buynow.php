<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buy_book'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $customer_username = $_SESSION['username'];

    // Fetch customer information from the customers table
    $customer_query = "SELECT phone_number, address FROM customers WHERE username = '$customer_username'";
    $customer_result = $conn->query($customer_query);
    $customer_info = $customer_result->fetch_assoc();
    $customer_phone = $customer_info['phone_number'];
    $customer_address = $customer_info['address'];

    // Fetch seller information from the sellers table (assuming there is only one seller)
    $seller_query = "SELECT added_by_seller FROM authors WHERE books='$book_name'";
    $seller_result = $conn->query($seller_query);
    $seller_info = $seller_result->fetch_assoc();
    $seller_username = $seller_info['added_by_seller'];

    // Fetch book price from the authors table
    $price_query = "SELECT price FROM authors WHERE id = '$book_id'";
    $price_result = $conn->query($price_query);
    $price_info = $price_result->fetch_assoc();
    $price = $price_info['price'];

    $img_query = "SELECT images FROM authors WHERE id = '$book_id'";
    $img_result = $conn->query($img_query);
    $img_info = $img_result->fetch_assoc();
    $img = $img_info['images'];


    // Generate a unique order ID

    // Insert the order information into the orders table
    $order_query = "INSERT INTO orders ( customer_username, customer_phone, customer_address, seller_username, book_name, author_name,images, quantity, prices, status, created_at, updated_at)
                    VALUES ( '$customer_username', '$customer_phone', '$customer_address', '$seller_username', '$book_name', '$author_name','$img', 1, '$price', 'Pending', NOW(), NOW())";

    if ($conn->query($order_query) === TRUE) {
        header('Location: loginresults.php?feedback=success');
    } else {
        echo "Error: " . $order_query . "<br>" . $conn->error;
    }
}
else {
    header('Location: loginresults.php'); // Redirect to user page if not POST request
    exit();
}

$conn->close();
?>