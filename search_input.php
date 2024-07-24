<?php
$departure=$_POST["departure"];
$arival=$_POST["arival"];
$departureDate=$_POST["departureDate"];

 $con=mysqli_connect("localhost","root","") or die(mysqli_error());

 if($con){
     $db="create database if not exists train_ticket_booking";
     mysqli_query($con,$db) or die(mysqli_error($con));
     mysqli_select_db($con,"train_ticket_booking") or die(mysqli_error($con));
     $table="CREATE TABLE IF NOT EXISTS schedule (
        NO INT(11) NOT NULL AUTO_INCREMENT,
        Date VARCHAR(100) NOT NULL, 
        DepartureDate DATE NOT NULL,
        weekday VARCHAR(100) NOT NULL, 
        dayno VARCHAR(100) NOT NULL,
        DeparturePlace VARCHAR(100) NOT NULL, 
        ArivalPlace VARCHAR(100) NOT NULL,
        DepartureTime TIME NOT NULL, 
        ArivalTime TIME NOT NULL,
        journeyTime VARCHAR(100) NOT NULL,
        price VARCHAR(100) NOT NULL,
        Month VARCHAR(100) NOT NULL,
        year YEAR NOT NULL,
        fulldate DATE NOT NULL,
        PRIMARY KEY (NO)
        );
";
     mysqli_query($con,$table) or die(mysqli_error($con));
   
     if ($departure != "" && $arival != "") {
        // Both departure and arrival are provided
        $search = "SELECT * FROM schedule WHERE DeparturePlace LIKE '%$departure%' AND ArivalPlace LIKE '%$arival%'";
    } elseif ($departure == "" && $arival == "" && $departureDate == "") {
        // Both departure and arrival are empty
        $search = "SELECT * FROM schedule";
    } elseif ($arival != "") {
        // Only arrival is provided
        $search = "SELECT * FROM schedule WHERE ArivalPlace LIKE '%$arival%'";
    } elseif ($departure != "") {
        // Only departure is provided
        $search = "SELECT * FROM schedule WHERE DeparturePlace LIKE '%$departure%'";
    } elseif ($departureDate!="") {
        
        // Only departure date is provided
        $search = "SELECT * FROM schedule WHERE fulldate LIKE '%$departureDate%'";
    }
    $result = mysqli_query($con, $search) or die(mysqli_error($con));

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
        <a href="schedule.php"><i class="fa-solid fa-arrow-left-long"></i></a>
        </div>
        
        <nav class="title" id="title">
           <h3>search single tiket schedule </h3>
        </nav>

        <div class="icons">
            <i id="user" class="fa-solid fa-user"></i>
        </div>
    </header>
 <div class="details">
    <div class="scheuledetails">
        <div class="cardheader">
            <h2>2024</span></h2>
                
        </div>       
            <?php

                    echo"
                    <table>
                    <capLion><b>Train Schedule</b></capLion>
        
                        <tr>
                            <th>NO</th>
                            <th>Date</th>
                            <th>Departure place</th>
                            <th>Arival place</th>
                            <th>Departure Time</th>
                            <th>Journey Time</th>
                            <th>Arival Time</th>
                            <th>Price</th>
                            <th>Month</th>
                            <th>Year</th>
                            
                        </tr>
                    ";
                        $num=mysqli_num_rows($result) or die(mysqli_error($con));
                        for($r=1;$r<=$num;$r++){
                        $row=mysqli_fetch_array($result) or die(mysqli_error($con));
                            $no=$row['NO'];
                            $date=$row['Date'];
                            $departureP=$row['DeparturePlace'];
                            $arivalP=$row['ArivalPlace'];
                            $departureT=$row['DepartureTime'];
                            $arivalT=$row['ArivalTime'];
                            $journey=$row['journeyTime'];
                            $price=$row['price'];
                            $month=$row['Month'];  
                            $year=$row['year'];  
                   echo"
                            <tr>
                            <td>$no</td>
                            <td>$date</td>
                            <td>$departureP</td>
                            <td>$arivalP</td>
                            <td>$departureT</td>
                            <td>$arivalT</td>
                            <td>$journey</td>
                            <td>$price ETB</td>
                            <td>$month</td>
                            <td>$year</td>
                            </tr>
                            ";
                   }
                   echo"</table>";

            ?>
        </div>
       
    </div>
        
    <script>
        let btn = document.querySelector('#btn');
        let sideBar = document.querySelector('.side_bar');
        btn.onclick = function() {
            sideBar.classList.toggle('active');
        };
    </script>
</body>
</html>