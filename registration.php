<?php
// Check if all fields are filled out
if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])){
	// Check if the email address is valid
	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

		// Check if the password and confirm password fields match
		if ($_POST['password'] == $_POST['confirm_password']){

			$file = fopen("users.csv", "a");

			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['password'];

			// Hash password for security
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			// Write the user registration information to the CSV file
			fputcsv($file, array($first_name, $last_name, $email, $hashed_password));

			fclose($file);

			echo "Registration successfully done! <a href='login.php'>Login here</a>";
		} else {
			echo "Password do not match.";
		}
	} else {
		echo "Invalid Email Address.";
	}
} else {
	echo "Please fillup all fields.";
}