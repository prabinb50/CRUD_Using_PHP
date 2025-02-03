<?php
session_start();
include 'dbcon.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST['register'])) {
    $fullName = mysqli_real_escape_string($connection, $_POST['fullName']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];

    if (empty($fullName) || empty($username) || empty($_POST['password']) || empty($confirm_password)) {
        $error = "Please fill in all fields.";
    } else if ($_POST['password'] != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $check_query = "SELECT username FROM users WHERE username = '$username'";
        $check_result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "Username already exists. Please choose a different username.";
        } else {
            $query = "INSERT INTO users (full_name, username, password) VALUES ('$fullName', '$username', '$password')";
            if (mysqli_query($connection, $query)) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!-- P@$$wOrd123 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register</h3>
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form action="register.php" method="post">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                <span id="togglePassword" class="bi bi-eye" style="cursor: pointer;"></span>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter your confirm password" required>
                                <span id="toggleConfirmPassword" class="bi bi-eye" style="cursor: pointer;"></span>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                            <p class="mt-2 text-center">Already have an account? <a href="login.php">Login</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>