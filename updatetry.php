
<?php
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


    $id=$_POST['no'];

     $Departure=$_POST['departuredate'];
                $date=$Departure;
                $departuremomth=date('M', strtotime($date));
                $departureyear=date('Y', strtotime($date));
                $departureday=date('d', strtotime($date));
                $departuredate=date('l', strtotime($date));
                $departuretime=date('h:i A',strtotime($date));
               $departureconca=$departuredate." ".$departureday;

     $DepartureDate =$departureconca;
     $WeekDay=$departuredate;
     $DayNO=$departureday;
     $DepartureTime= $departuretime;
     $Arivaltime= $departuretime;
     $DeparturePlace=$_POST['departureplace'];
     $ArivalPlace=$_POST['arivalplace'];
     $journeyTime=$_POST['journeyTime'];
     $price=$_POST['price'];
     $Month=$departuremomth;
     $Year=$departureyear; 

    $upd="update schedule set 	 
    DeparturePlace='$DeparturePlace',
    ArivalPlace='$ArivalPlace',
    DepartureTime='$departuretime',
    ArivalTime='$departuretime',
    journeyTime='$journeyTime',
    price='$price' where NO = '$id'";
    
    mysqli_query($con,$upd) or die(mysqli_error($con));
 
include('schedule.php');

echo"
<script>
alert('Data is updated');
</script>
";

 }
 ?>