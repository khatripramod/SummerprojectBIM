<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "books", 3306);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the search parameter is present in the request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $authorName = $_POST["authorName"];

    // Fetch the search results
    $query = "SELECT id, full_name, pdfs, books, images FROM authors WHERE books LIKE '%$authorName%'";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search results</title>
    <link rel="stylesheet" href="results.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="#">
                    <img src="image.png" alt="Logo">
                </a>
            </div>
            <div class="search-bar">
                <form method="POST" action="results.php">
                    <input type="text" name="authorName" class="bar" placeholder="Search Books" required>
                </form>
            </div>
        </nav>
    </header>

    <table>
        <thead>
            <tr>
                <th>Book Image</th>
                <th>Book Name</th>
                <th>Author Name</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($result) && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><img src="bookimg/<?php echo $row['images']; ?>" alt="Book Image"></td>
                        <td><?php echo $row["books"]; ?></td>
                        <td><?php echo $row["full_name"]; ?></td>
                        <td>
    <div class="button-container">
        <form method="post" action="buybooks.php" class="button-form">
            <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="book_name" value="<?php echo $row['books']; ?>">
            <input type="hidden" name="author_name" value="<?php echo $row['full_name']; ?>">
        </form>
    </div>
</td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No search results found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>