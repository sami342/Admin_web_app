<?php
$con = mysqli_connect("localhost", "root", "") or die(mysqli_error($con));

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
        password VARCHAR(255) NOT NULL
    )";
    mysqli_query($con, $table) or die(mysqli_error($con));
    
    // Get form data
    $email = $_POST["uemail"];
    $password = $_POST["upassword"];
    $name = $_POST['uname'];
    $workid = $_POST['uworkid'];
    
    // Prepare and execute the query to select the record from admin_account based on email, name, and workid
    $stmt = $con->prepare("SELECT * FROM admin_account WHERE email = ? AND name = ? AND workid = ?");
    $stmt->bind_param("sss", $email, $name, $workid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];
        
        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, delete the user
            $stmt_delete = $con->prepare("DELETE FROM admin_account WHERE email = ? AND name = ? AND workid = ?");
            $stmt_delete->bind_param("sss", $email, $name, $workid);
            $stmt_delete->execute();
            
            // Check if user was deleted successfully
            if ($stmt_delete->affected_rows > 0) {
                // User deleted successfully
                echo "
                <script>
                alert('Account removed successfully');
                window.location.href = 'adminlogin.php';
                </script>
                ";
            } else {
                // Error deleting user
                echo "
                <script>
                alert('Error removing account');
                window.location.href = 'adminlogin.php';
                </script>
                ";
            }
        } else {
            // Password is incorrect
            echo "
            <script>
            alert('Incorrect email, name, work ID, or password');
            window.location.href = 'adminlogin.php';
            </script>
            ";
        }
    } else {
        // No user found with the provided email, name, and workid
        echo "
        <script>
        alert('User not found');
        window.location.href = 'adminlogin.php';
        </script>
        ";
    }

    // Close the statements and connection
    $stmt->close();
    $stmt_delete->close();
    $con->close();
}
?>
