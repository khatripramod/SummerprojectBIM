<?php
// Start the session
session_start();

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

    // Update the order status in the database
    $update_query = "UPDATE orders SET status = '$status', updated_at = NOW() WHERE order_id = '$order_id'";
    mysqli_query($conn, $update_query);
}

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search_term = $_GET['search'];
    $search_query = "WHERE order_id LIKE '%$search_term%' OR customer_username LIKE '%$search_term%' OR seller_username LIKE '%$search_term%'";
}

// Fetch all orders
$query = "SELECT * FROM orders $search_query";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}
?>
<html>
    <head>
        <title>ORDERS</title>
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
            }

            th {
                background-color: #f2f2f2;
            }

            .search-container {
                display: flex;
                justify-content: center;
                align-items: center;
                font-weight: 100;
                overflow: hidden;
            }

            .search-container input[type="text"] {
                width: 400px;
                padding: 10px;
                font-size: 16px;
            }
        </style>
    </head>
    <Body>
        <div class="container">
            <a href="admin.php">
                <img class="logo" src="logobg.png" alt="Logo" height="120" width="160">
            </a>
        </div>

        <div class="search-container">
            <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
               <input type="text" name="search" placeholder="Orderid / customerUsername / sellerUsername" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Customer Username</th>
                <th>Customer Phone</th>
                <th>Customer Address</th>
                <th>Seller Username</th>
                <th>Book Name</th>
                <th>Author Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Change Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['customer_username']; ?></td>
                    <td><?php echo $row['customer_phone']; ?></td>
                    <td><?php echo $row['customer_address']; ?></td>
                    <td><?php echo $row['seller_username']; ?></td>
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
                                <option value="complete" <?php if ($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                <option value="Cancel" <?php if ($row['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>