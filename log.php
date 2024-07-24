<?php
$con=mysqli_connect("localhost","root","") or die(mysqli_error());

if ($con) {
    // Create the database if it doesn't exist
    $db = "CREATE DATABASE IF NOT EXISTS train_ticket_booking";
    mysqli_query($con, $db) or die(mysqli_error($con));
    
    // Select the database
    mysqli_select_db($con, "train_ticket_booking") or die(mysqli_error($con));
    
    // Create the admin_account table if it doesn't exist
    $table = "CREATE TABLE IF NOT EXISTS admin_account (
        name VARCHAR(100) NOT NULL,
        workid VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(100) NOT NULL
    )";
    mysqli_query($con, $table) or die(mysqli_error($con));
    
    // Query to select all records from admin_account
    $select = "SELECT * FROM admin_account";
    $result = mysqli_query($con, $select) or die(mysqli_error($con));
    
    // Check the number of rows in the result
    if (mysqli_num_rows($result) == 0) {
        // No admin registered, redirect to admin registration page
        echo "
        <script>
        alert('You have to create an account for once');
        window.location.href = 'adminregister.php';
        
        </script>
        ";
        
    } else {
        // Admin already registered, redirect to admin login page
        echo "
        <script>
        alert('This site can be used only by Admin. Please contact your company for more details.');
        window.location.href = 'adminlogin.php';
        </script>
        ";
    }
}
?>

   


