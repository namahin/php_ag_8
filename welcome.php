<?php
// Start session to access user information
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    // User is not logged in, so redirect to login page
    header("Location: login.php");
    exit();
}

// Display welcome message with user's first name
echo "Welcome, " . $_SESSION['first_name'] . "!";
?>
