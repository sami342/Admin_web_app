<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['role'])) {
    header("Location: adminlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainAdmin.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <header>
        <div class="menu">
           <a href="sideBar.php"><i class="fa-solid fa-arrow-left-long"></i></a>
        </div>
        <nav class="title" id="title">
           <h3>Passenger Feedback Information</h3>
        </nav>
        
        <div class="icons">
            <i id="user" class="fa-solid fa-user"></i>
        </div>
    </header>
    <div class="details">
        <div class="scheuledetails">
            <div class="cardheader">
                <h2>Feedback</span></h2>
            </div>
            <?php
            
                $con = mysqli_connect("localhost", "root", "") or die(mysqli_error($con));

                if ($con) {
                    $db = "create database if not exists train_ticket_booking";
                    mysqli_query($con, $db) or die(mysqli_error($con));
                    mysqli_select_db($con, "train_ticket_booking") or die(mysqli_error($con));

                    // Fetch data from feedback table
                    $search_feedback = "select * from feedback";
                    $result_feedback = mysqli_query($con, $search_feedback) or die(mysqli_error($con));

                    // Check if there is data in the feedback table
                    if (mysqli_num_rows($result_feedback) == 0) {
                        echo "
                        <script>
                        alert('There is no feedback data registered');
                        </script>
                        ";
                    } else {
                        // Display feedback data in a table
                        echo "
                        <table>
                        <caption><b>Feedback</b></caption>
                            <tr>
                                <th>First Name</th>
                                <th>Email</th>
                                <th>Feedback</th>
                                <th>Rating</th>
                            </tr>
                        ";

                        while ($row = mysqli_fetch_array($result_feedback)) {
                            echo "
                            <tr>
                                <td>{$row['first_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['feedback']}</td>
                                <td>{$row['rating']}</td>
                            </tr>
                            ";
                        }

                        echo "</table>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>
