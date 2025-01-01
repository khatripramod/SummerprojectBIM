<html>
<head>
  <title>Kitab.com login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="icon.png">
  <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
<div style="position:absolute; left:-10px; top:-40px;">
    <a href="index.php">
      <img src="logobg.png" height="200" />
    </a>
  </div>
<form method="POST" action="" class="form">
       <p class="form-title">Sign in as Seller</p>
        <div class="input-container">
          <input type="text" placeholder="Enter Username" name="username">
          <span>
          </span>
      </div>
      <div class="input-container">
          <input type="password" placeholder="Enter password" name="password" required>
        </div>
         <button type="submit" class="submit">
        Sign in
      </button>
      <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && (!isset($user) || !password_verify($password, $user['password']))): ?>
        <p style="color: red;">Incorrect username or password</p>
    <?php endif; ?>

      <p class="signup-link">
        No account?
        <a href="signup.php">Sign up</a>
      </p>
   </form>
   <?php require_once 'sellerdb.php'; ?>
</body>

</html>

