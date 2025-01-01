<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["bookname"]) && !empty($_POST["bookname"])) {
        $authorName = $_POST["bookname"];

        $userquery = "SELECT * FROM authors WHERE books LIKE '%$authorName%'";
        $result = $conn->query($userquery);

        if ($result->num_rows > 0) {
            $userRows = array();
            while ($row = $result->fetch_assoc()) {
                $userRows[] = $row;
            }
        } else {
            echo "Books not found.";
        }
    }
}

// Update book logic
if (isset($_POST['update'])) {
    $id = $_POST['book_id'];
    $author = $_POST['full_name'];
    $books = $_POST['books'];
    $pdfs = $_POST['pdf'];
    $price = $_POST['price'];
    $images=$_POST['images'];
    $stocks = $_POST['stocks'];
    $added = $_POST['added_by_seller'];
    $updateQuery = "UPDATE authors SET  full_name='$author',books='$books', pdfs='$pdfs', price='$price',images='$images', stocks='$stocks', added_by_seller='$added' WHERE id='$id'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete book logic
if (isset($_POST['delete'])) {
    $id = $_POST['book_id'];

    $deleteQuery = "DELETE FROM authors WHERE id='$id'";
    if ($conn->query($deleteQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>