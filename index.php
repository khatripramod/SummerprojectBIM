<html>
    <head>
        <title>Kitab.com</title>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="icon.png">
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
                    <form method="POST" action="results.php">
                        <input type="text" name="authorName" class="bar" placeholder="Search Books" required>
                    </form>
                </div>
                <div>
                <a href="#books" class="authors-link">Books</a>
    <a href="#authors" class="authors-link">Authors</a>  
</div>
                <div class="auth-buttons">
                    <a href="login.php"> <button>Sign In</button></a>
                    <a href="signup.php"> <button>Sign Up</button></a>
                </div>
            </nav>
        </header>
        <section id="books">
        <div class="bookimage">
            <div class="image-container">
                <a href="login.php"><img src="bookimg/ch1.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/ch2.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/ch3.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/ch4.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/ch5.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/ch6.jpg" alt="chetanbhagat"></a>
            </div>
            <div class="image-container">
                <a href="login.php"><img src="bookimg/hp1.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/hp2.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/hp3.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/hp4.png" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/hp5.jpg" alt="chetanbhagat"></a>
                <a href="login.php"><img src="bookimg/hp6.png" alt="chetanbhagat"></a>
            </div>
        </div>
</section>
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





        <footer>
            <p>&copy; 2024. All rights reserved Pramod Khatri.</p>
        </footer>
    </body>
</html>