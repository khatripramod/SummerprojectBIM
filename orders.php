<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Get the logged-in seller's username
$seller_username = $_SESSION['username'];

// Connect to the database
require_once 'ordersdb.php';

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the order status if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Check if the order ID is valid
    $check_query = "SELECT * FROM orders WHERE order_id = '$order_id' AND seller_username = '$seller_username'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        // Update the order status in the database
        $update_query = "UPDATE orders SET status = '$status', updated_at = NOW() WHERE order_id = '$order_id' AND seller_username = '$seller_username'";
        mysqli_query($conn, $update_query);
    } else {
        echo "Error: Invalid order ID or you don't have permission to update this order.";
    }
}

// Fetch orders for the logged-in seller
$query = "SELECT * FROM orders WHERE seller_username = '$seller_username'";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}
?>
<html>
    <head>
        <title>SWAGATAM</title>
        <link rel="stylesheet" href="adminis.css">
        <link rel="icon" type="image/x-icon" href="icon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-radius: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    </head>
    <Body>
        <div class="container">
        <a href="sellerpage.php">
            <img class="logo" src="logobg.png" alt="Logo" height="120" width="160"></a>
</div>
<h2>Orders for seller   (<?php echo $seller_username; ?>)</h2>

<table>
    <tr>
        <th>Order ID</th>
        <th>Customer Username</th>
        <th>Customer Phone</th>
        <th>Customer Address</th>
        <th>Book Name</th>
        <th>Author Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_username']; ?></td>
            <td><?php echo $row['customer_phone']; ?></td>
            <td><?php echo $row['customer_address']; ?></td>
            <td><?php echo $row['book_name']; ?></td>
            <td><?php echo $row['author_name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['prices']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><?php echo $row['updated_at']; ?></td>
            <td>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                        <select name="status">
                            <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                            <option value="processing" <?php if ($row['status'] == 'processing') echo 'selected'; ?>>Processing</option>
                            <option value="shipped" <?php if ($row['status'] == 'shipped') echo 'selected'; ?>>Shipped</option>
                            <option value="delivered" <?php if ($row['status'] == 'delivered') echo 'selected'; ?>>Delivered</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
