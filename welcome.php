<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // User is not logged in, so redirect to login page
    header("Location: login.php");
    exit();
}

// Display welcome message with user's first name

echo "<h1>Welcome, " . $_SESSION['first_name'] . "!</h1>";

?>
