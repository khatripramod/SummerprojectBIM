<?php require_once 'db-connection.php'; ?>
<html>
    <head>
        <title>SWAGATAM</title>
        <link rel="stylesheet" href="user.css">
        <link rel="icon" type="image/x-icon" href="icon.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <style>
            .success-message {
                background-color: #d4edda;
                color: #155724;
                padding: 10px;
                border: 1px solid #c3e6cb;
                border-radius: 4px;
                margin-bottom: 10px;
                text-align: center;
            }
            
            .message-container {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(255, 255, 255, 0.9);
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                z-index: 9999;
            }
        </style>
    </head>
    <body>
    <header>
            <nav>
                <div class="logo">
                    <a href="#">
                        <img src="image.png" alt="Logo">
                    </a>
                </div>
                <div class="search-bar">
                    <form method="POST" action="loginresults.php">
                        <input type="text" name="authorName" class="bar" placeholder="Search Books" required>
                    </form>
                </div>
                <?php
                session_start();

                // Database connection
                $conn = mysqli_connect("localhost", "root", "", "books", 3306);

                // Check if user is logged in
                if(isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];

                    // Query to fetch user information based on username
                    $query = "SELECT * FROM users WHERE username = '$username'";
                    $result = mysqli_query($conn, $query);

                    // Check if query was successful
                    if ($result) {
                        // Fetch user information
                        $user = mysqli_fetch_assoc($result);

                        // Display button with user information as data attributes
                        echo '<div class="auth-buttons">';
                        echo '<button class="login" id="userButton" data-username="' . $user['username'] . '" data-email="' . $user['email'] . '"><i class="fas fa-user"></i> ' . $username . '</button>';
                    } else {
                        echo '<div class="auth-buttons"><button class="login" id="userButton">Login</button>'; // If error occurs, display regular login button
                    }
                } else {
                    echo '<div class="auth-buttons"><button class="login" id="userButton">Login</button>';
                }
                ?>
                <a href="customercart.php"><button class="login">My cart</button></a>
                </div>
                <div id="userMenu" style="display: none;">
                    <a href="myaccount.php">Account</a>
                    <a href="customerorders.php">Orders</a>
                    <a href="logout.php">Sign Out</a>
                </div>
                <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Listen for click event on login button
            var loginBtn = document.getElementById('userButton');
            loginBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default button action
                toggleUserMenu();
            });
        });

        function toggleUserMenu() {
            var userMenu = document.getElementById("userMenu");
            var loginBtn = document.getElementById("userButton");
            var isMenuVisible = userMenu.style.display === "block";

            // Hide/show the user menu
            userMenu.style.display = isMenuVisible ? "none" : "block";

            // Position the menu below the button and horizontally align it with the button's center
            var buttonRect = loginBtn.getBoundingClientRect();
            userMenu.style.position = 'absolute';
            userMenu.style.top = (buttonRect.bottom + window.scrollY) + 'px'; // Position below the button
            userMenu.style.left = (buttonRect.left + (buttonRect.width / 2) - (userMenu.offsetWidth / 2)) + 'px'; // Horizontally align with button center
        }
    </script>
            </nav>
    </header>
    <?php
        // Check if the success message is set in the URL
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo '<div class="message-container"><div class="success-message">Item added to cart successfully!</div></div>';
            echo '<script>
                    var messageContainer = document.querySelector(".message-container");
                    setTimeout(function() {
                        messageContainer.style.display = "none";
                    }, 2000); // Hide the message container after 2 seconds (2000 milliseconds)
                </script>';
        }
        ?>
    <div class="bookimage">
    <div class="book-container">
        <img src="bookimg/ch1.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="One Indian Girl">Buy</button>
            <button value="One Indian Girl">Read for Free</button>
        </div>
    </div>
        <div class="book-container">
        <img src="bookimg/ch2.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="Revolution 2020">Buy</button>
            <button value="Revolution 2020">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/ch3.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="400 Days">Buy</button>
            <button value="400 Days">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/ch4.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="What young india">Buy</button>
            <button value="What young india">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/ch5.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="2 states">Buy</button>
            <button value="2 states">Read For free</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/ch6.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="Five">Buy</button>
            <button value="Five">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/hp1.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="Harry Potter and the Sorcerers Stone">Buy</button>
            <button value="Harry Potter and the Sorcerers Stone">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/hp2.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="Harry Potter and the Chamber of Secrets">Buy</button>
            <button value="Harry Potter and the Chamber of Secrets">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/hp3.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="Harry Potter and the Prisoner of Azkaban">Buy</button>
            <button value="Harry Potter and the Prisoner of Azkaban">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/hp4.png" alt="chetanbhagat">
        <div class="book-options">
            <button value="Harry Potter and the Goblet of Fire">Buy</button>
            <button value="Harry Potter and the Goblet of Fire">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/hp5.jpg" alt="chetanbhagat">
        <div class="book-options">
            <button value="Harry Potter and the Order of the Phoenix">Buy</button>
            <button value="Harry Potter and the Order of the Phoenix">Read Now</button>
        </div>
    </div>
    <div class="book-container">
        <img src="bookimg/hp6.png" alt="chetanbhagat">
        <div class="book-options">
            <button value="Harry Potter and the Half-Blood Prince">Buy</button>
            <button value="Harry Potter and the Half-Blood Prince">Read Now</button>
        </div>
    </div>
    <script>
            document.querySelectorAll('.book-options button').forEach(button => {
                button.addEventListener('click', function() {
                    const authorName = this.value;
                    const searchForm = document.querySelector('form[action="loginresults.php"]');
                    const searchInput = searchForm.querySelector('input[name="authorName"]');

                    // Populate the search input with the book title
                    searchInput.value = authorName;

                    // Submit the search form
                    searchForm.submit();
                });
            });
        </script>
            </div>
            <div class="quotes-container">
    <div class="quote left-quote">
        <img src="authorimg/marcus.jpg" alt="Marcus Tullius Cicero">
        <div class="quote-content">
            <p>"A room without books is like a body without a soul." -Marcus Tullius Cicero </p>
        </div>
    </div>
    <div class="quote right-quote">
        <div class="quote-content">
            <p>"The more that you read, the more things you will know. The more that you learn, the more places you'll go."  -Dr. Seuss </p>
        </div>
        <img src="authorimg/seuss.jpg" alt="Dr. Seuss">
    </div>
    
</div>
<section class="authors-section" id="authors">
<h2>Featured Authors</h2>
    <div class="container">
        <div class="author">
            <img src="authorimg/chetan.jpg" alt="chetan">
            <p>Chetan Bhagat</p>
        </div>
        <div class="author">
            <img src="authorimg/jkrowling.jpg" alt="rowling">
            <p>J. K. Rowling</p>
        </div>
        <div class="author">
            <img src="authorimg/george.jpg" alt="rowling">
            <p>George R. R. Martin</p>
        </div>
        <div class="author">
            <img src="authorimg/paulo.png" alt="paulo">
            <p>Paulo Coelho</p>
        </div>
    </div>
</section>



    <div class="feedback-container">
        <h2>Feedback & Complaints</h2>
        <form method="POST" action="feedbackform.php">
            <label for="feedback">Your Feedback/Complaint:</label><br>
            <textarea id="feedback" name="feedback" rows="4" cols="50" required></textarea><br><br>
            <input type="submit" value="Submit">
        </form>
        <?php
if (isset($_GET['feedback']) && $_GET['feedback'] === 'success') {
    echo '<div class="success-message">Thank you for your feedback!</div>';
}
?>
    </div>

    <footer>
        <p>&copy; 2024. All rights reserved Pramod Khatri.</p>
    </footer>
    </body>
</html>
