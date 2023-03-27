<?php
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
                if (password_verify($password, $row[3])) {
                    $_SESSION['first_name'] = $row[0];
                    $_SESSION['last_name'] = $row[1];
                    $_SESSION['email'] = $row[2];

                    // Redirect user to welcome page
                    header("Location: welcome.php");
                    exit();
                } else {
                    // Password is incorrect display error message
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




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!--  -->
    <link rel="stylesheet" href="style.css">

<body>

<section class="form-sec">
        <div class="container">

<!-- login form -->
        <form method="post">
        <h1>User Login</h1>
        <div class="field">
            <label>Email address:</label>
            <input type="email" name="email" required>
        </div>
        <div class="field">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
            <?php if (isset($error)): ?>
                <div class="error" style="color: red; margin-top: 10px;"><?php echo $error; ?></div>
            <?php endif; ?>

            <button class="btn" type="submit">Log in</button>
        </form>

            </div>
        
        </section>
    
    </body>
    
    </html>
