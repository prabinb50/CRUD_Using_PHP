<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    
    include 'dbcon.php'; // Include database connection file

    // Check if the update_student button is clicked
    if (isset($_POST['update_student'])) {
        // Retrieve and sanitize input values
        $id = intval($_POST['id']);
        $fname = mysqli_real_escape_string($connection, $_POST['f_name']);
        $lname = mysqli_real_escape_string($connection, $_POST['l_name']);
        $age = intval($_POST['age']);

        // Validate input fields
        if (empty($fname) || empty($lname) || empty($age)) {
            echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
            exit();
        }

        // Validate name fields for letters and spaces only
        if (!preg_match('/^[a-zA-Z\s]+$/', $fname) || !preg_match('/^[a-zA-Z\s]+$/', $lname)) {
            echo "<script>alert('Names can only contain letters and spaces.'); window.history.back();</script>";
            exit();
        }

        // Validate age (acceptable range: 0-120)
        if ($age < 0 || $age > 120) {
            echo "<script>alert('Age must be between 0 and 120.'); window.history.back();</script>";
            exit();
        }

        // Update the record in the database
        $sql = "UPDATE student SET first_name='$fname', last_name='$lname', age=$age WHERE id=$id";
        if (mysqli_query($connection, $sql)) {
            // Redirect to the homepage upon success
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            // Display error message on failure
            echo "<script>alert('Error: " . mysqli_error($connection) . "'); window.history.back();</script>";
        }
    }
?>
