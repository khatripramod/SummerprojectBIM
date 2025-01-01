<?php
include 'sellereditdb.php';
?>
<html>
<head>
    <title>Seller Information</title>
    <link rel="stylesheet" href="selleredit.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
    <div class="container">
        <a href="admin.php">
            <img class="logo" src="logobg.png" alt="Logo" height="120" width="160">
        </a>
        <div class="center"><h1>Seller Information</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="bar" required>
            <input type="submit" value="Search">
        </form></div>

        <?php
        if (isset($userRow) && isset($customerRow)) {
            ?>
            <h2>User Information</h2>
            <table>
                <tr>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Revenue</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
                <tr>
                    <td><?php echo $customerRow['full_name']; ?></td>
                    <td><?php echo $customerRow['username']; ?></td>
                    <td><?php echo $customerRow['email']; ?></td>
                    <td><?php echo $customerRow['gender']; ?></td>
                    <td><?php echo $customerRow['phone_number']; ?></td>
                    <td><?php echo $customerRow['address']; ?></td>
                    <td><?php echo $customerRow['revenue_generated']; ?></td>
                    <td><?php echo $customerRow['created_at']; ?></td>
                    <td><?php echo $customerRow['updated_at']; ?></td>
                </tr>
            </table>


            <h2>Edit Seller Information</h2>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="username" value="<?php echo $customerRow['username']; ?>">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $customerRow['full_name']; ?>" required>
                <label for="types">Types:</label>
                <input type="text" name="types" id="types" value="<?php echo $userRow['types']; ?>" required>
                <label for="gender">Gender:</label>
                <input type="text" name="gender" id="gender" value="<?php echo $customerRow['gender']; ?>" required>
                <label for="phone_number">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" value="<?php echo $customerRow['phone_number']; ?>" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $customerRow['email']; ?>" required>
                <label for="email">Address:</label>
                <input type="text" name="address" id="address" value="<?php echo $customerRow['address']; ?>" required><br><br>
                <label for="revenue_generated">Revenue:</label>
                <input type="text" name="revenue_generated" id="revenue_generated" value="<?php echo $customerRow['revenue_generated']; ?>" required><br>
                <input type="submit" name="update" class="update" value="Update">
                <input type="submit" name="delete" class="del" value="Delete" onclick="return confirm('Are you sure you want to delete this user and seller?')">
            </form>
            <?php
        }
        ?>
    </div>
</body>
</html>