<?php
 $con=mysqli_connect("localhost","root","") or die(mysqli_error());

 if($con){
     $db="create database if not exists Train_Ticket_booking";
     mysqli_query($con,$db) or die(mysqli_error($con));
     mysqli_select_db($con,"Train_Ticket_booking") or die(mysqli_error($con));
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

    
		$id=$_POST['deletevalue'];
		if($id==""){
			$currentDate = date('Y-m-d');
    // SQL query to delete records with fulldate less than the current date
    $deleteQuery = "DELETE FROM schedule WHERE fulldate < '$currentDate'";
		}
		else{
		$deleteQuery="delete from schedule where NO='$id'";	
		}
		$result=mysqli_query($con,$deleteQuery) or die(mysqli_error($con));

   

       $search1="select * from schedule";
       $result1=mysqli_query($con,$search1) or die(mysqli_error($con));
       
       $num=mysqli_num_rows($result1) or die(mysqli_error($con));
       $newno=1;
       for($r=1;$r<=$num;$r++){
       $row=mysqli_fetch_array($result1) or die(mysqli_error($con));
          $no=$row['NO'];
          if($no!=$r){
          $newno=$r;
            $upd="update schedule set NO='$newno' where NO = '$no'";
            mysqli_query($con,$upd) or die(mysqli_error($con));
          }
       }
            
        
    

        echo"
        <script>
        alert('all information is deleted!!!');
        </script>";
        include('sideBar.php');
 }
?>
