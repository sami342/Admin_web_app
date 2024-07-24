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

     function getShiftedWeekday($currentWeekday, $shiftDirection) {
        $weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        $index = array_search($currentWeekday, $weekdays);
        if ($index === false) {
            return $currentWeekday; // Return the same value if the current weekday is not found
        }
        if ($shiftDirection == "back") {
            $shiftedIndex = ($index - 1 + 7) % 7; // Go back one day
        } else {
            $shiftedIndex = ($index + 1) % 7; // Go forward one day
        }
        return $weekdays[$shiftedIndex];
    }

     
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $updateshift=$_POST['shiftupdate'];
    $updatedate=$_POST['departuredate'];
    
    $updatedate = substr($updatedate, 0, 10);
        // Check if the departure date is set
    
     if (isset($_POST['departuredate'])) {
    
        $departuredate = $_POST['departuredate'];
    
            $date = new DateTime($departuredate);

            $backday=new DateTime($departuredate);
    
            // Add one day to the date
    
            $date->modify('+1 day'); 
            $backday->modify('-1 day');

            $updated_date = $date->format('Y-m-d');
            $backday_date=$backday->format('Y-m-d');

        if($updateshift=="back"){
                $search="select * from schedule where fulldate>='$updatedate'";
                $result=mysqli_query($con,$search) or die(mysqli_error($con));
                $num=mysqli_num_rows($result) or die(mysqli_error($con));
                for($r=1;$r<=$num;$r++){
                $row=mysqli_fetch_array($result) or die(mysqli_error($con));
                     $no=$row['NO'];
                     $currentWeekday = $row['weekday'];
                     $DayNO=$row['dayno'];
                     $currentDate = $row['fulldate'];

                     $nextDate = date('Y-m-d', strtotime($currentDate . ' -1 day'));
                     $updtedDayNO = date('d', strtotime($nextDate));
                     $Month = date('F', strtotime($nextDate));
                     $nextWeekday = getShiftedWeekday($currentWeekday,$updateshift);

                    $updtedDayNO=$updtedDayNO;
                    $updateday=$nextWeekday;
                    $departuredateupdate= $updateday." ".$updtedDayNO;

                    $upd = "UPDATE schedule SET 
                    Date='$departuredateupdate',
                    weekday='$nextWeekday',
                    dayno='$updtedDayNO',
                    Month='$Month',
                    fulldate='$nextDate'
                    WHERE NO = '$no'";
    mysqli_query($con, $upd) or die(mysqli_error($con));
    
                    
                }
            }

            else if($updateshift=="no"){
               $search="SELECT * FROM schedule WHERE fulldate >='$updatedate'";
                $result=mysqli_query($con,$search) or die(mysqli_error($con));
                $num=mysqli_num_rows($result) or die(mysqli_error($con));
                for($r=1;$r<=$num;$r++){
                $row=mysqli_fetch_array($result) or die(mysqli_error($con));
                     $no=$row['NO'];
                     $currentWeekday = $row['weekday'];
                     $DayNO=$row['dayno'];
                     $currentDate = $row['fulldate'];
                     $nextDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
                     $updtedDayNO = date('d', strtotime($nextDate));
                     $Month = date('F', strtotime($nextDate));
                     $nextWeekday = getShiftedWeekday($currentWeekday,$updateshift);
                             $updtedDayNO=$updtedDayNO;
                             $updateday=$nextWeekday;
                             $departuredateupdate= $updateday." ".$updtedDayNO;
                $upd="update schedule set 	
                Date='$departuredateupdate',
                weekday='$nextWeekday',
                dayno='$updtedDayNO',
                Month='$Month',
                fulldate='$nextDate'   where NO = '$no'";
                mysqli_query($con,$upd) or die(mysqli_error($con));
         }            
    }


        } else {
            echo "<script>alert('Please select a date.')</script>";
        }
        } else {
            echo "<script>alert('Invalid request method.')</script>";
        }

    include("schedule.php");
	echo"
	<script>
	alert('Data is updated');
	</script>
	";

}

else{
	include("schedule.php");
	echo"
	<script>
	alert('No Database Connection');
	</script>
	";


 }

?>