<?php
include 'booksadddb.php';
?>
<html>
<head>
    <title> Add Books</title>
    <link rel="stylesheet" href="Booksadd.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <div class="container">
        <a href="#">
            <img class="logo" src="logobg.png" alt="Logo" height="120" width="160">
        </a>
        <h2>Add Books</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="full_name">Author Name:</label>
            <input type="text" id="full_name" name="full_name" required>

            <label for="books">Book Name:</label>
            <input type="text" id="books" name="books" required>

            <label for="pdf">PDF:</label>
            <input type="file" id="pdf" name="pdf"  required>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" step="0.01" required>

            <label for="images">Image:</label>
            <input type="file" id="image" name="image"  required><br><br>

            <label for="stocks">Stock:</label>
            <input type="text" id="stocks" name="stocks" required>

            <label for="added_by_seller">Seller:</label>
            <input type="text" id="added_by_seller" name="added_by_seller" placeholder="seller username" required>


            <input type="submit" value="Add Book">
        </form>
    </div>
</body>
</html>

