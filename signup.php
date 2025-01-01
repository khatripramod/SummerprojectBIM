<?php
$showSuccessMessage = false;
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    $showSuccessMessage = true;
}
require_once 'signupdb.php';
?>
<html>
<head>
    <title>Kitab.com Signup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="signup.css">
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            width: 50%;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .topic {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        .uname {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .submit3 {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit3:hover {
            background-color: #34fff0;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div style="position:absolute; left:10px; top:10px;">
    <a href="index.php">
        <img src="image.png" />
    </a>
</div>
<div class="container">
    <?php if ($showSuccessMessage): ?>
        <div class="success-message">Thank you for registering. Welcome to Kitab.com!!!</div>
    <?php else: ?>
        <div class="topic"><h1>Create your Account</h1></div>
        <div class="positionform">
            <form method="POST" action="">
                <table>
                    <tr>
                        <td></td>
                        <td>
                            <input type="radio" name="costumer" value="Customer" required>Customer
                            <input type="radio" name="costumer" value="Seller" required>Seller
                        </td>
                    </tr>
                    <tr>
                        <td>Fullname:</td>
                        <td><input type="text" name="fullname" class="uname" required></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" class="uname" required></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="email" name="email" class="uname" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" class="uname" required></td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td>
                            <input type="radio" name="gender" value="m" required>Male
                            <input type="radio" name="gender" value="f" required>Female
                        </td>
                    </tr>
                    <tr>
                        <td>Phone no:</td>
                        <td>
                            <select name="phoneCode" required>
                                <option selected hidden value="">Select Code</option>
                                <option value="977">+977 Nepal</option>
                                <option value="91">+91 India</option>
                                <option value="975">+975 Bhutan</option>
                                <option value="880">+880 Bangladesh</option>
                                <option value="92">+92 Pakistan</option>
                                <option value="94">+94 Srilanka</option>
                                <option value="960">+960 Maldives</option>
                            </select>
                            <input type="phone" name="phone" class="uname" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><input type="address" name="address" class="uname" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;"><input type="submit" value="Submit" class="submit3"></td>
                    </tr>
                </table>
            </form>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
