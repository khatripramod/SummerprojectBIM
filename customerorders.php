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
    $check_query = "SELECT * FROM orders WHERE order_id = '$order_id' AND customer_username = '$seller_username'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        // Update the order status in the database
        $update_query = "UPDATE orders SET status = '$status', updated_at = NOW() WHERE order_id = '$order_id' AND customer_username = '$seller_username'";
        mysqli_query($conn, $update_query);
    } else {
        echo "Error: Invalid order ID or you don't have permission to update this order.";
    }
}

// Fetch orders for the logged-in seller
$query = "SELECT * FROM orders WHERE customer_username = '$seller_username'";
$result = mysqli_query($conn, $query);

// Check for query errors
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SWAGATAM</title>
    <link rel="stylesheet" href="customerorders.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <style>
        table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Slightly raised effect */
  border-radius: 8px; /* Rounded corners */
}

th, td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
  text-transform: uppercase;
  color: #333;
}

tr:nth-child(even) {
  background-color: #f7f7f7; /* Alternate row color for better distinction */
}

tr:hover {
  background-color: #e6e6e6;
}

.status {  
  background-color: #f5f5f5; /* Light background for status */
  color: #666; /* Darker text color for status */
  font-weight: bold; /* Emphasize status */
  border-radius: 4px; /* Rounded corners */
}

    </style>
</head>
<body>
    <div class="container">
        <a href="welcome.php">
            <img class="logo" src="image.png" >
        </a>
    </div>
    <h2>Orders for Customer (<?php echo $seller_username; ?>)</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Phone</th>
            <th>Customer Address</th>
            <th>Seller</th>
            <th>Book Name</th>
            <th>Author Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['order_id']; ?></td>
                <td><?php echo $row['customer_phone']; ?></td>
                <td><?php echo $row['customer_address']; ?></td>
                <td><?php echo $row['seller_username']; ?></td>
                <td><?php echo $row['book_name']; ?></td>
                <td><?php echo $row['author_name']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['prices']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>