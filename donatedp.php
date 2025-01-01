<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $condition = $_POST['condition'];

    // Prepare SQL statement
    $sql = "INSERT INTO donations (full_name, Address, phone_number, bookname, authorname, condition_book, created_at) 
            VALUES ('$name', '$address', '$phone', '$book_name', '$author_name', '$condition', NOW())";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>