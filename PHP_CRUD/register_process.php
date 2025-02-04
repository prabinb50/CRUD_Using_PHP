<?php
session_start(); // Start session to store error messages
include 'includes/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user input
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = trim($_POST['phone']);

    // Array to collect errors
    $errors = [];

    // Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($confirm_password) || empty($phone)) {
        $errors[] = "All fields are required.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Password validation: Minimum 8 characters, at least 1 uppercase, 1 number, 1 special character
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least one uppercase letter.";
    }
    if (!preg_match('/\d/', $password)) {
        $errors[] = "Password must contain at least one number.";
    }
    if (!preg_match('/[@$!%*?&]/', $password)) {
        $errors[] = "Password must contain at least one special character (@$!%*?&).";
    }

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If errors exist, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: register.php"); // Redirect back to the registration page
        exit;
    }

    // Sanitize email before using in the database
    $email = mysqli_real_escape_string($connection, $email);

    // Check if email already exists using a prepared statement
    $check_email_query = "SELECT email FROM users WHERE email = ?";
    $stmt = $connection->prepare($check_email_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['errors'] = ["Email already exists. Please choose a different email."];
        header("Location: register.php");
        exit;
    }
    $stmt->close();

    // Hash the password securely before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data using a prepared statement
    $insert_query = "INSERT INTO users (first_name, last_name, email, password, phone) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($insert_query);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $phone);

    // // Execute the query and check for success

    if ($stmt->execute()) {
        header("Location: upload_photo.php?email=" . urlencode($email));
        exit;
    } else {
        $_SESSION['errors'] = ["Error: " . $stmt->error];
        header("Location: register.php");
        exit;
    }

    // Close database connection
    $stmt->close();
    mysqli_close($connection);
}
?>
