<?php
// Start session to store user information
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if all fields are filled out
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Escape user inputs for security
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Open the CSV file for reading
        $file = fopen("users.csv", "r");

        // Loop through each row in the CSV file
        while (($row = fgetcsv($file)) !== false) {
            // Check if the email address matches
            if ($row[2] == $email) {
                // Email address matches, so check if the password is correct
                if (password_verify($password, $row[3])) {
                    // Password is correct, so store user information in session
                    $_SESSION['first_name'] = $row[0];
                    $_SESSION['last_name'] = $row[1];
                    $_SESSION['email'] = $row[2];

                    // Redirect user to welcome page
                    header("Location: welcome.php");
                    exit();
                } else {
                    // Password is incorrect, so display error message
                    $error = "Invalid login credentials.";
                }
                break;
            }
        }

        // Close the CSV file
        fclose($file);

        // Display error message if email address was not found
        if (!isset($error)) {
            $error = "Invalid login credentials.";
        }
    } else {
        // Not all fields were filled out, so display error message
        $error = "Please fill out all fields.";
    }
}
?>

<!-- HTML code for login form -->
<form method="post">
    <label>Email address:</label>
    <input type="email" name="email" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <button type="submit">Log in</button>
</form>
