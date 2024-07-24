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
           <a href="notification.php"><i class="fa-solid fa-arrow-left-long"></i></a>
        </div>
        <nav class="title" id="title">
           <h3>One passenger Detail booking information</h3>
        </nav>
        
        <div class="icons">
            <i id="user" class="fa-solid fa-user"></i>
        </div>
    </header>
    <div class="details">
        <div class="scheuledetails">
            <div class="cardheader">
                <h2>January<span>&nbsp;2024</span></h2>
            </div>
            <?php
                $id = $_POST['phNO'];
                $con = mysqli_connect("localhost", "root", "") or die(mysqli_error($con));

                if ($con) {
                    $db = "create database if not exists train_ticket_booking";
                    mysqli_query($con, $db) or die(mysqli_error($con));
                    mysqli_select_db($con, "train_ticket_booking") or die(mysqli_error($con));

                    // Fetch data from passenger table
                    $search_passenger = "select * from passenger where phone LIKE '%$id%' or textReference LIKE '%$id%' or date LIKE '%$id%'";
                    $result_passenger = mysqli_query($con, $search_passenger) or die(mysqli_error($con));

                    // Fetch data from cancleticket table
                    $search_cancleticket = "select * from cancleticket where phone LIKE '%$id%' or textReference LIKE '%$id%' or date LIKE '%$id%'";
                    $result_cancleticket = mysqli_query($con, $search_cancleticket) or die(mysqli_error($con));

                    // Check if there is data in either table
                    if (mysqli_num_rows($result_passenger) == 0 && mysqli_num_rows($result_cancleticket) == 0) {
                        echo "
                        <script>
                        alert('There is no data registered');
                        </script>
                        ";
                    } else {
                        echo "
                        <table>
                        <caption><b>Passenger</b></caption>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Age</th>
                                <th>Departure place</th>
                                <th>Arival place</th>
                                <th>Class</th>
                                <th>Cargo</th>
                                <th>Seat</th>
                                <th>Ticket Reference</th>
                            </tr>
                        ";

                        // Display data from passenger table
                        while ($row = mysqli_fetch_array($result_passenger)) {
                            echo "
                            <tr>
                                <td>{$row['FirstName']}</td>
                                <td>{$row['MiddleName']}</td>
                                <td>{$row['LastName']}</td>
                                <td>{$row['Age']}</td>
                                <td>{$row['DeparturePlace']}</td>
                                <td>{$row['ArrivalPlace']}</td>
                                <td>{$row['Class']}</td>
                                <td>{$row['Cargo']}</td>
                                <td>{$row['Seat']}</td>
                                <td>{$row['TextReference']}</td>
                            </tr>
                            ";
                        }

                        // Display data from cancleticket table
                        while ($row = mysqli_fetch_array($result_cancleticket)) {
                            echo "
                            <tr>
                                <td>{$row['FirstName']}</td>
                                <td>{$row['MiddleName']}</td>
                                <td>{$row['LastName']}</td>
                                <td>{$row['Age']}</td>
                                <td>{$row['DeparturePlace']}</td>
                                <td>{$row['ArivalPlace']}</td>
                                <td>{$row['Class']}</td>
                                <td>{$row['Cargo']}</td>
                                <td>{$row['Seat']}</td>
                                <td>{$row['TextReference']}</td>
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
