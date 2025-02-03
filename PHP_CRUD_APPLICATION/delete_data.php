<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
    include 'dbcon.php'; // Include database connection file

    // Check if the delete_id is passed via GET
    if (isset($_GET['delete_id'])) {
        $id = intval($_GET['delete_id']); // Sanitize the ID value
        $sql = "DELETE FROM student WHERE id=$id"; // SQL query to delete the record

        if (mysqli_query($connection, $sql)) {
            // Redirect to the homepage upon success
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            // Display error message on failure
            echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
        }
    }
?>
