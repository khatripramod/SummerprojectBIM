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

    // Insert data into the "author" table
    $sql = "INSERT INTO authors (full_name, books) VALUES ('$full_name', '$books')";

    if ($conn->query($sql) === TRUE) {
        echo "Author added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close connection
$conn->close();
?>