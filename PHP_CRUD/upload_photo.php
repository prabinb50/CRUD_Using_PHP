<?php
session_start();
include 'includes/dbcon.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
} else {
    header("Location: register.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "images/"; // Directory to store images
    $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (limit set to 500KB)
    if ($_FILES["profile_photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only specific file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, PNG, JPEG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Upload file if no errors
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
            // Update user profile photo in database
            $update_query = "UPDATE users SET profile_photo = '$target_file' WHERE email = '$email'";
            if (mysqli_query($connection, $update_query)) {
                header("Location: login.php"); // Redirect to login after successful upload
                exit;
            } else {
                echo "Error updating profile photo: " . mysqli_error($connection);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Photo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation Bar -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">MyWebsite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Profile Upload Section -->
<main class="container mt-5 d-flex justify-content-center">
    <div class="card p-4 shadow-sm" style="max-width: 500px; width: 100%; border-radius: 10px;">
        <h2 class="text-center mb-3">Upload Your Profile Photo</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <!-- File Input -->
            <div class="mb-3">
                <input type="file" class="form-control" name="profile_photo" id="profile_photo" required>
            </div>
            <!-- Upload Button -->
            <button type="submit" class="btn btn-primary w-100">Upload</button>
        </form>
    </div>
</main>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-light">
    <div class="container text-center">
        <span class="text-muted">&copy; 2023 MyWebsite</span>
    </div>
</footer>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Internal CSS Styling Below Navbar -->
<style>
    /* Center the form and add styling */
    .card {
        background: #ffffff;
        border: 1px solid #ddd;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Input field focus effect */
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Button hover effect */
    .btn-primary:hover {
        background-color: #0056b3;
        transition: 0.3s ease-in-out;
    }
</style>

</body>
</html>