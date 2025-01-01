<?php
session_start();

// Destroy the session.
session_destroy();

// Redirect to the home page or login page.
header("Location: index.php"); // Replace 'index.php' with your desired landing page after logout.
exit();
?>
