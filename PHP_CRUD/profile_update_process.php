<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'includes/dbcon.php';
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);

    // Handle profile photo update if a new photo was uploaded
    if (!empty($_FILES["profile_photo"]["name"])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // ... (File upload validation - similar to upload_photo.php) ...

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                $update_query = "UPDATE users SET profile_photo = '$target_file' WHERE id = '$user_id'";
                mysqli_query($connection, $update_query); // Update profile photo path
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update other user details
    $update_query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email', phone = '$phone' WHERE id = '$user_id'";

    if (mysqli_query($connection, $update_query)) {
        header("Location: profile.php"); // Redirect back to profile page
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }

    mysqli_close($connection);
}
?>