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
           <a href="passenger.php"><i class="fa-solid fa-arrow-left-long"></i></a>
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

           $id=$_POST['phNO'];
            $con=mysqli_connect("localhost","root","") or die(mysqli_error());

            if($con){
                
                $db="create database if not exists train_ticket_booking";
                mysqli_query($con,$db) or die(mysqli_error($con));
                mysqli_select_db($con,"train_ticket_booking") or die(mysqli_error($con));
 
                $search="select * from passenger where phone LIKE'%$id%' or textReference LIKE'%$id%' or date LIKE'%$id%'";

                $result=mysqli_query($con,$search) or die(mysqli_error($con));

                if($search==NULL){
                    echo"
                    <script>
                    alert('There is no data registered');
                    </script>
                    ";
                }
                else{
                    echo"
                    <table>
                    <capLion><b>Passenger</b></capLion>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</td>
                            <th>Age</th>
                            <th>Departure place</th>
                            <th>Arival place</th>
                            <th>Class</th>
                            <th>Cargo</th>
                            <th>Seat</th>
                            <th>Ticket Reference</th>
                        </tr>
                    ";
                        $num=mysqli_num_rows($result) or die(mysqli_error($con));
                        for($r=1;$r<=$num;$r++){
                        $row=mysqli_fetch_array($result) or die(mysqli_error($con));
                             $no=$row['NO'];
                             $Fname=$row['FirstName'];
                             $Mname=$row['MiddleName'];
                             $Lname=$row['LastName'];
                             $age=$row['Age'];
                             $sex=$row['Sex'];
                             $departureP=$row['DeparturePlace'];
                             $arivalP=$row['ArrivalPlace'];
                             $class=$row['Class'];
                             $cargo=$row['Cargo'];
                             $seat=$row['Seat'];
                             $phone=$row['Phone'];
                             $ticketRef=$row['TextReference'];
                            
                  
                   echo"
                            <tr>
                            
                            <td>$Fname</td>
                            <td>$Mname</td>
                            <td>$Lname</td>
                            <td>$age</td>
                            <td>$departureP</td>
                            <td>$arivalP</td>
                            <td>$class</td>
                            <td>$cargo</td>
                            <td>$seat</td>
                            <td>$ticketRef</td>
                           
                            </tr>
                            ";
                   } 
                   echo"</table>";
                }
            }
        ?>
        </div>
       
    </div>
</body>
</html>