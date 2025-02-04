<?php
    // Database connection
    $connection = mysqli_connect("127.0.0.1", "root", "", "crud_operations", 3307);

    // Check connection
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    // else {
    //     echo "Connection successfully created";
    // }
    
?>
