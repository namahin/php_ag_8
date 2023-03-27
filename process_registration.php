<?php
// Check if all fields are filled out
if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
	// Check if the email address is valid
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		// Check if the password and confirm password fields match
		if ($_POST['password'] == $_POST['confirm_password']) {
			// Passwords match, so we can proceed with registration

			// Open the CSV file in append mode
			$file = fopen("users.csv", "a");

			// Escape user inputs for security
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Hash the password for security
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			// Write the user registration information to the CSV file
			fputcsv($file, array($first_name, $last_name, $email, $hashed_password));

			// Close the CSV file
			fclose($file);

			// Display success message
			echo "Registration successful!";
		} else {
			// Passwords don't match, so display error message
			echo "Passwords do not match.";
		}
	} else {
		// Invalid email address, so display error message
		echo "Invalid email address.";
	}
} else {
	// Not all fields were filled out, so display error message
	echo "Please fill out all fields.";
}
?>
