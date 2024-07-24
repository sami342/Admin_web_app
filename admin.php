<?php
$con = mysqli_connect("localhost", "root", "") or die(mysqli_error($con));
if ($con) {
    $db = "CREATE DATABASE IF NOT EXISTS train_ticket_booking";
    mysqli_query($con, $db) or die(mysqli_error($con));
    
    // Select the database
    mysqli_select_db($con, "train_ticket_booking") or die(mysqli_error($con));
    
    // Create the admin_account table if it doesn't exist
    $table = "CREATE TABLE IF NOT EXISTS admin_account (
        name VARCHAR(100) NOT NULL,
        workid VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    mysqli_query($con, $table) or die(mysqli_error($con));

    $name = $_POST["uname"];
    $workid = $_POST["uworkid"];
    $email = $_POST["uemail"];
    $password = $_POST["upassword"];

    // Check if there is already an admin account
    $check = "SELECT * FROM admin_account";
    $result = mysqli_query($con, $check) or die(mysqli_error($con));

    if (mysqli_num_rows($result) > 0) {
        echo "
        <script>
        alert('An admin is already registered.');
        </script>
        ";
        include('adminlogin.php');
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = "INSERT INTO admin_account (name, workid, email, password) VALUES ('$name','$workid','$email','$hashed_password')";
        mysqli_query($con, $insert) or die(mysqli_error($con));
        
        echo "
        <script>
        alert('Data is registered');
        </script>
        ";
        include('adminlogin.php');
    }
}
?>
