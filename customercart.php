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

// Update the order quantity or delete the item if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['cart_id'];
    $action = $_POST['action'];

    // Check if the order ID is valid
    $check_query = "SELECT * FROM carts WHERE cart_id = '$order_id' AND customer_username = '$seller_username'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        if ($action === 'update') {
            $quantity = $_POST['quantity'];
            // Update the order quantity in the database
            $update_query = "UPDATE carts SET quantity = '$quantity' WHERE cart_id = '$order_id' AND customer_username = '$seller_username'";
            mysqli_query($conn, $update_query);
        } elseif ($action === 'delete') {
            // Delete the order from the database
            $delete_query = "DELETE FROM carts WHERE cart_id = '$order_id' AND customer_username = '$seller_username'";
            mysqli_query($conn, $delete_query);
        }
    } else {
        echo "Error: Invalid order ID or you don't have permission to update this order.";
    }
}

// Fetch orders for the logged-in seller
$query = "SELECT * FROM carts WHERE customer_username = '$seller_username'";
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
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 20px;
        }

        .cart-item-details {
            flex-grow: 1;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
        }

        .cart-item-actions input {
            width: 60px;
            margin: 0 10px;
            text-align: center;
        }

        .cart-total {
            text-align: right;
            font-weight: bold;
            margin-top: 20px;
        }

        .buy-now-button {
            display: block;
            margin: 20px auto 0;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .updatebttn{
            margin: 10px ;
            padding: 10px 8px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }
        .deletebttn{
            margin: 10px ;
            padding: 10px 10px;
            background-color: #b3ffff;
            color:#000303;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="welcome.php">
        <img class="logo" src="image.png" alt="Logo"  width="150 px">
    </a>
</div>
<h2>Your cart (<?php echo $seller_username; ?>)</h2>

<div class="cart-container">
    <?php
    $total_price = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $item_price = $row['prices'] * $row['quantity'];
        $total_price += $item_price;
    ?>
        <div class="cart-item">
            <img src="bookimg/<?php echo $row['images']; ?>" alt="Book Image">
            <div class="cart-item-details">
                <h3><?php echo $row['book_name']; ?></h3>
                <p><strong>Price:</strong> Rs<?php echo $row['prices']; ?></p>
            </div>
            <div class="cart-item-actions">
                <form method="POST" action="">
                    <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                    <input type="hidden" name="action" value="update">
                    <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                    <button type="submit" class="updatebttn">Update</button>
                </form>
                <form method="POST" action="">
                    <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit" class="deletebttn">Delete</button>
                </form>
            </div>
        </div>
    <?php } ?>
    <div class="cart-total">Total Price: Rs <?php echo $total_price; ?></div>
    <form action="payment.php" method="POST">
        <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
        <button type="submit" class="buy-now-button">Buy Now</button>
    </form>
</div>
</body>
</html>