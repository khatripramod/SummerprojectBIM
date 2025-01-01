<?php
include 'bookseditdb.php';
?>
<html>
<head>
    <title>Book Information</title>
    <link rel="stylesheet" href="booksedit.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
<div class="container">
        <a href="admin.php">
            <img class="logo" src="image.png" >
        </a>
    </div>
        <div class="center"><h1>Book Information</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="bookname">Bookname:</label>
            <input type="text" name="bookname" id="bookname" class="bar" required>
            <input type="submit" value="Search">
        </form></div>
        <?php
if (isset($userRows)): {
    ?>
    <h2>Books Information</h2>
    <table>
        <tr>
            <th>Author Name</th>
            <th>Books</th>
            <th>PDF</th>
            <th>Price</th>
            <th>Image</th>
            <th>Stocks</th>
            <th>Added by Seller</th>
        </tr>
        <?php foreach ($userRows as $userRow): ?>
            <tr>
                <td><?php echo $userRow['full_name']; ?></td>
                <td><?php echo $userRow['books']; ?></td>
                <td>
                <?php if (!empty($userRow['pdfs'])): ?>
                    <a href="bookspdf/<?php echo $userRow['pdfs']; ?>" target="_blank">View PDF</a>
                <?php else: ?>
                    No PDF available
                <?php endif; ?>
            </td>
                <td><?php echo $userRow['price']; ?></td>
                <td><img src="bookimg/<?php echo $userRow['images']; ?>" alt="Book Image" height="200"></td>
                <td><?php echo $userRow['stocks']; ?></td>
                <td><?php echo $userRow['added_by_seller']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h2>Update or Delete Book</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="book_id">Book ID:</label>
                <input type="text" name="book_id" id="book_id" value="<?php echo $userRow['id']; ?>" required>

                <label for="full_name">Author Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $userRow['full_name']; ?>" required>
                
                <label for="books">Book Name:</label>
                <input type="text" name="books" id="books" value="<?php echo $userRow['books']; ?>">
                
                <label for="pdf">PDF:</label>
                <input type="file" name="pdf" id="pdf" value="<?php echo $userRow['pdfs']; ?>">
                
                <label for="price">Price:</label>
                <input type="text" name="price" id="price" value="<?php echo $userRow['price']; ?>"><br><br>

                <label for="images">Image:</label>
                <input type="file" name="images" id="images" value="<?php echo $userRow['images']; ?>">

                <label for="stocks">Stocks:</label>
                <input type="text" name="stocks" id="stocks" value="<?php echo $userRow['stocks']; ?>">

                <label for="added_by_seller">Seller:</label>
                <input type="text" name="added_by_seller" id="added_by_seller" value="<?php echo $userRow['added_by_seller']; ?>"> 

                <input type="submit" name="update" value="Update">
                <input type="submit" name="delete" value="Delete">
            </form>
    
    <?php
        }
        ?>
        <?php endif; ?>
    </body>
</html>