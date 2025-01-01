<?php
$conn = mysqli_connect("localhost","root","","books",3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs to prevent SQL injection
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $books = $conn->real_escape_string($_POST['books']);
    $pdfs = $conn->real_escape_string($_POST['pdf']);
    $price= $conn->real_escape_string($_POST['price']);
    $image= $conn->real_escape_string($_POST['image']);
    $stock= $conn->real_escape_string($_POST['stocks']);
    $added= $conn->real_escape_string($_POST['added_by_seller']);

    // Insert data into the "author" table
    $sql = "INSERT INTO authors (full_name, books, pdfs, price, images, stocks, added_by_seller) VALUES ('$full_name', '$books','$pdfs', '$price','$image', '$stock','$added')";

    if ($conn->query($sql) === TRUE) {
        echo "Author added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close connection
$conn->close();
?>