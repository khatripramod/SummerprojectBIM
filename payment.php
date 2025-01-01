<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Get the logged-in customer's username
$customer_username = $_SESSION['username'];

// Connect to the database
require_once 'ordersdb.php';

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the total price from the form submission
$total_price = $_POST['total_price'];

// Check if the payment method is selected
if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];

    // Process the payment based on the selected method
    if ($payment_method === 'online') {
        // Handle online payment (e.g., redirect to a payment gateway)
        echo "Processing online payment...";
        // Add your payment gateway integration code here
    } elseif ($payment_method === 'cod') {
        // Handle cash on delivery
        $payment_status = 'Cash on Delivery';
        $status = 'Pending';

        // Fetch the cart items for the logged-in customer
        $cart_query = "SELECT * FROM carts WHERE customer_username = '$customer_username'";
        $cart_result = mysqli_query($conn, $cart_query);

        while ($cart_row = mysqli_fetch_assoc($cart_result)) {
            // Insert the order details into the database
            $insert_query = "INSERT INTO orders (customer_username, customer_phone, customer_address, seller_username, book_name, author_name, images, quantity, prices, payment_status, status, created_at, updated_at) VALUES (
                '{$cart_row['customer_username']}',
                '{$cart_row['customer_phone']}',
                '{$cart_row['customer_address']}',
                '{$cart_row['seller_username']}',
                '{$cart_row['book_name']}',
                '{$cart_row['author_name']}',
                '{$cart_row['images']}',
                '{$cart_row['quantity']}',
                '{$cart_row['prices']}',
                '$payment_status',
                '$status',
                NOW(),
                NOW()
            )";

            if (mysqli_query($conn, $insert_query)) {
                echo "Order placed successfully. Your order will be processed for cash on delivery.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }

        // Clear the cart
        $clear_cart_query = "DELETE FROM carts WHERE customer_username = '$customer_username'";
        mysqli_query($conn, $clear_cart_query);
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>SWAGATAM</title>
        <link rel="stylesheet" href="adminis.css">
        <link rel="icon" type="image/x-icon" href="icon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <style>
            .payment-container {
                max-width: 400px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f5f5f5;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .payment-container h2 {
                text-align: center;
            }

            .payment-container label {
                display: block;
                margin-bottom: 10px;
            }

            .payment-container input[type="radio"] {
                margin-right: 5px;
            }

            .payment-container button {
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
        </style>
    </head>
    <body>
    <div class="container">
        <a href="welcome.php">
            <img class="logo" src="image.png" alt="Logo"  width="150 px">
        </a>
    </div>
    <div class="payment-container">
        <h2>Select Payment Method</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
            <label>
                <input type="radio" name="payment_method" value="online"> Online Payment
            </label>
            <label>
                <input type="radio" name="payment_method" value="cod"> Cash on Delivery
            </label>
            <button type="submit">Continue</button>
        </form>
    </div>
    </body>
    </html>
    <?php
}

// Close the database connection
mysqli_close($conn);
?>