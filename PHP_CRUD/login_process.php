<?php
session_start();
include 'includes/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if fields are empty
    if (empty($email) || empty($password)) {
        $_SESSION['errors'] = ["All fields are required."];
        header("Location: login.php");
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'] = ["Invalid email format."];
        header("Location: login.php");
        exit;
    }

    // Check user in database using prepared statement
    $query = "SELECT id, first_name, password FROM users WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If user exists, verify password
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $first_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['first_name'] = $first_name;
            header("Location: profile.php"); // Redirect to user profile
            exit;
        } else {
            $_SESSION['errors'] = ["Incorrect password."];
        }
    } else {
        $_SESSION['errors'] = ["User not found."];
    }

    $stmt->close();
    mysqli_close($connection);
    header("Location: login.php");
    exit;
}
?>
