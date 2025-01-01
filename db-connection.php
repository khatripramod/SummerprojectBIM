<?php
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// for search
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorName = $_POST["authorName"];

    $query = "SELECT id, full_name, books, images FROM authors WHERE books LIKE '%$authorName%'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Redirect to the results.php page with the search results
        $searchResults = array();
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = array(
                'image' => base64_encode($row["images"]),
                'book' => $row["books"],
                'author' => $row["full_name"]
            );
        }
        $searchResultsEncoded = urlencode(json_encode($searchResults));
        header("Location: results.php?search=" . $searchResultsEncoded);
        exit();
    } else {
        echo "No authors found for the specified name.";
    }
}
?>