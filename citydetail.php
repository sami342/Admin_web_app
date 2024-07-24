<!-- PHP code to echo accepted name -->
<?php

session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['role'])) {
    header("Location: adminlogin.php");
    exit();
}

if(isset($_GET['name'])) {
    $accepted_name = $_GET['name'];

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
            <a href="sideBar.php">
                <i class="fa-solid fa-home"></i>
            </a>
        </div>

        <nav class="title" id="title">
           <h3><?php echo $accepted_name; ?> all passenger ticket booking information</h3>
        </nav>

        <div class="icons">
            <i id="user" class="fa-solid fa-user"></i>
        </div>
    </header>
    <div class="details">
        <div class="scheuledetails">
            <div class="cardheader">
                <h2>2024 <span>&nbsp;All Passengers</span></h2>
                <div class="search">
                    <form action="passenger_search.php" method="POST" enctype="multipart/form-data">
                        <input name="phNO" type="search" placeholder="Search here">
                        <button>
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <?php
                $con = mysqli_connect("localhost", "root", "") or die(mysqli_error());

                if ($con) {
                    $db = "create database if not exists train_ticket_booking";
                    mysqli_query($con, $db) or die(mysqli_error($con));
                    mysqli_select_db($con, "train_ticket_booking") or die(mysqli_error($con));

                    $check_table_query = "SHOW TABLES LIKE 'passenger'";
                    $result = mysqli_query($con, $check_table_query);

                    if (mysqli_num_rows($result) == 0) {
                        $table = "CREATE TABLE IF NOT EXISTS passenger (
                            NO INT AUTO_INCREMENT PRIMARY KEY,
                            FirstName VARCHAR(255),
                            MiddleName VARCHAR(255),
                            LastName VARCHAR(255),
                            Age INT,
                            Sex VARCHAR(10),
                            DeparturePlace VARCHAR(255),
                            ArrivalPlace VARCHAR(255),
                            Class VARCHAR(50),
                            Cargo VARCHAR(50),
                            Seat VARCHAR(50),
                            Phone VARCHAR(15),
                            Date DATE,
                            TextReference VARCHAR(255)
                        );";
                        mysqli_query($con, $table) or die(mysqli_error($con));
                    }

                    // Using $accepted_name in the query
                    $accepted_name = mysqli_real_escape_string($con, $accepted_name); // Sanitize input
                    $search = "SELECT * FROM passenger WHERE DeparturePlace = '$accepted_name'";
                    $result = mysqli_query($con, $search) or die(mysqli_error($con));

                    if (mysqli_num_rows($result) == 0) {
                        echo "<script>alert('There is no data registered');</script>";
                    } else {
                        echo "
                            <table>
                                <caption><b>Passengers</b></caption>
                                <tr>
                                    <th>NO</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Sex</th>
                                    <th>Departure place</th>
                                    <th>Arrival place</th>
                                    <th>Class</th>
                                    <th>Cargo</th>
                                    <th>Seat</th>
                                    <th>Ticket Reference</th>
                                </tr>";
                        while ($row = mysqli_fetch_array($result)) {
                            $no = $row['NO'];
                            $Fname = $row['FirstName'];
                            $Mname = $row['MiddleName'];
                            $Lname = $row['LastName'];
                            $age = $row['Age'];
                            $sex = $row['Sex'];
                            $departureP = $row['DeparturePlace'];
                            $arrivalP = $row['ArrivalPlace'];
                            $class = $row['Class'];
                            $cargo = $row['Cargo'];
                            $seat = $row['Seat'];
                            $phone = $row['Phone'];
                            $textRef = $row['TextReference'];
                            echo "
                                <tr>
                                    <td>$no</td>
                                    <td>$Fname</td>
                                    <td>$Lname</td>
                                    <td>$sex</td>
                                    <td>$departureP</td>
                                    <td>$arrivalP</td>
                                    <td>$class</td>
                                    <td>$cargo</td>
                                    <td>$seat</td>  
                                    <td>$textRef</td>  
                                </tr>";
                        }
                        echo "</table>";
                    }

                    // Count the number of male and female passengers
                    $count_male = mysqli_query($con, "SELECT COUNT(*) AS count FROM passenger WHERE DeparturePlace = '$accepted_name' AND Sex = 'Male'");
                    $count_female = mysqli_query($con, "SELECT COUNT(*) AS count FROM passenger WHERE DeparturePlace = '$accepted_name' AND Sex = 'Female'");
                    $num_males = mysqli_fetch_assoc($count_male)['count'];
                    $num_females = mysqli_fetch_assoc($count_female)['count'];

                    // Count the number of VIP and Normal class passengers
                    $count_vip = mysqli_query($con, "SELECT COUNT(*) AS count FROM passenger WHERE DeparturePlace = '$accepted_name' AND Class = 'VIP'");
                    $count_normal = mysqli_query($con, "SELECT COUNT(*) AS count FROM passenger WHERE DeparturePlace = '$accepted_name' AND Class = 'Normal'");
                    $num_vip = mysqli_fetch_assoc($count_vip)['count'];
                    $num_normal = mysqli_fetch_assoc($count_normal)['count'];
                }
            ?>
        </div>
        <div class="report">
            <div class="reportdetails">
                <div class="cardheader">
                    <h2><i class="fa-solid fa-city"></i></h2>
                    <label>Total</label><br>
                    <strong><?php echo mysqli_num_rows($result); ?></strong>
                </div>
            </div>
            <div class="reportdetails">
                <div class="cardheader">
                    <h2><i class="fa-solid fa-person"></i></h2>
                    <label>Males</label><br>
                    <strong><?php echo $num_males; ?></strong>
                </div>
            </div>
            <div class="reportdetails">
                <div class="cardheader">
                    <h2><i class="fa-solid fa-female"></i></h2>
                    <label>Females</label><br>
                    <strong><?php echo $num_females; ?></strong>
                </div>
            </div>
            <div class="reportdetails">
                <div class="cardheader">
                    <h2><i class="fa-solid fa-crown"></i></h2>
                    <label>VIP</label><br>
                    <strong><?php echo $num_vip; ?></strong>
                </div>
            </div>
            <div class="reportdetails">
                <div class="cardheader">
                    <h2><i class="fa-solid fa-chair"></i></h2>
                    <label>Normal</label><br>
                    <strong><?php echo $num_normal; ?></strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
