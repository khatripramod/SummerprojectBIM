<?php require_once 'donatedp.php';?> 
<html>
<head>
    <title>Book Donation Form</title>
</head>
<body>
<link rel="stylesheet" href="donate.css">
    <h2>Book Donation Form</h2>
    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"  class="uname" required><br><br>

        <label for="address">Address:</label><br>
        <textarea id="address" name="address" class="uname" required></textarea><br><br>

        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone"  class="uname" required><br><br>

        <label for="book_name">Name of the Book:</label><br>
        <input type="text" id="book_name" name="book_name"  class="uname" required><br><br>
        <label for="book_name">Author of the Book   :</label><br>
        <input type="text" id="book_name" name="author_name"  class="uname" required><br><br>

        <label for="condition">Condition of the Book:</label><br>
        <input type="radio" id="new" name="condition" value="New" required>
        <label for="new">New</label><br>

        <input type="radio" id="good_as_new" name="condition" value="Good as New">
        <label for="good_as_new">Good as New</label><br>

        <input type="radio" id="old" name="condition" value="Old">
        <label for="old">Old</label><br>

        <input type="radio" id="very_old" name="condition" value="Very Old">
        <label for="very_old">Very Old</label><br><br>

        <input type="submit" value="Submit" class="submit3">
    </form>
</body>
</html>
