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

     $Departure=$_POST['departuredate'];

                $date=$Departure;
                $departuremomth=date('M', strtotime($date));
                $departureyear=date('Y', strtotime($date));
                $departureday=date('d', strtotime($date));
                $departuredate=date('l', strtotime($date));
                $departuretiem=date('h:i A',strtotime($date));
                $departureconca=$departuredate." ".$departureday;

     $DepartureDate =$departureconca;

     $Weekday=$departuredate;
     $daynumber=$departureday;
        
     $DeparturePlace=$_POST['departureplace'];
     $ArivalPlace=$_POST['arrivalplace'];

     $DepartureTime=$departuretiem;
     $ArivalTime=$_POST['arrivalplace'];

     $price=$_POST['price'];
     $month=$departuremomth;
     $year=$departureyear;  

     // Extract only the date part (YYYY-MM-DD)
    $departureonlyDate = substr($Departure, 0, 10);


if($DeparturePlace=="Adiss Abeba" && $ArivalPlace=="Dire Dawa"){
     $queries=array(   
  $insert1="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
  VALUES ('$DepartureDate','$Weekday','$daynumber','Adiss Abeba','Bishoftu','$DepartureTime','3:30AM','3HR','150','$month','$year','$departureonlyDate')",
   
   $insert2="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday' ,'$daynumber','Adiss Abeba','Mojo','$DepartureTime','4:00AM','3HR 30M','200','$month','$year','$departureonlyDate')",
   
                  
   $insert3="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adiss Abeba','Adama','$DepartureTime','4:30AM','4HR','250','$month','$year','$departureonlyDate')",
   
   $insert4="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adiss Abeba','Messo','$DepartureTime','9:00AM','8HR','450','$month','$year','$departureonlyDate')",
   
   $insert5="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adiss Abeba','Bike','$DepartureTime','11:00AM','10HR','550','$month','$year','$departureonlyDate')",
   
   $insert6="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adiss Abeba','Dire Dawa','$DepartureTime','12:30pM','12HR 30M','750','$month','$year','$departureonlyDate')",
   
   $insert7="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Bishoftu','Mojo','3:30AM','4:00AM','30M','150','$month','$year','$departureonlyDate')",
   
   $insert8="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Bishoftu','Adama','3:30AM','4:30AM','1HR','250','$month','$year','$departureonlyDate')",
   
   $insert9="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Bishoftu','Messo','3:30AM','9:00AM','7HR','500','$month','$year','$departureonlyDate')",
   
   $insert10="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Bishoftu','Bike','3:30AM','11:00AM','9HR','550','$month','$year','$departureonlyDate')",
   
   $insert11="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Bishoftu','Dire Dawa','3:30AM','12:30AM','10HR','650','$month','$year','$departureonlyDate')",
   
   $insert12="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Mojo','Adama','4:00AM','4:30AM','30M','150','$month','$year','$departureonlyDate')",
   
   $insert13="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Mojo','Messo','4:00AM','9:00AM','5HR','450','$month','$year','$departureonlyDate')",
   
   $insert14="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Mojo','Bike','4:00AM','11:0AM','6HR','550','$month','$year','$departureonlyDate')",
   
   $insert15="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Mojo','Dire Dawa','4:00AM','12:30AM','8HR 30M','600','$month','$year','$departureonlyDate')",
   
   
   $insert16="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adama','Messo','4:30AM','9:0AM','5HR 30M','350','$month','$year','$departureonlyDate')",
   
   $insert17="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adama','Bike','4:30AM','11:0AM','7HR','400','$month','$year','$departureonlyDate')",
   
   $insert18="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Adama','Dire Dawa','4:30AM','12:30AM','8HR','550','$month','$year','$departureonlyDate')",
   
   $insert19="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Messo','Bike','9:00AM','11:00AM','2HR','250','$month','$year','$departureonlyDate')",
   
   $insert20="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Messo','Dire Dawa','9:00AM','12:30AM','3HR 30M','350','$month','$year','$departureonlyDate')",
   
   $insert21="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
   VALUES ('$DepartureDate','$Weekday','$daynumber','Bike','Dire Dawa','11:00AM','12:30AM','1HR 30M','250','$month','$year','$departureonlyDate')",
      );
     
         foreach ($queries as $insert) {
         mysqli_query($con, $insert); 
         }
         echo"
         <script>
         alert('All data inserted successfully!!!');
         </script>
         ";
         include('sideBar.php');

     }
 else if($DeparturePlace=="Dire Dawa" && $ArivalPlace=="Adiss Abeba"){
         $queries=array(

         
        $insert1="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
        VALUES ('$DepartureDate','$Weekday','$daynumber','Dire Dawa','Bike','$DepartureTime','3:30AM','2HR','150','$month','$year','$departureonlyDate')",
         
         $insert2="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday' ,'$daynumber','Dire Dawa','Meso','$DepartureTime','5:00AM','4HR 30M','250','$month','$year','$departureonlyDate')",
         
                        
         $insert3="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Dire Dawa','Adama','$DepartureTime','10:00AM','9HR 30M','550','$month','$year','$departureonlyDate')",
         
         $insert4="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Dire Dawa','Mojo','$DepartureTime','10:30AM','10HR','600','$month','$year','$departureonlyDate')",
         
         $insert5="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Dire Dawa','Bishoftu','$DepartureTime','11:30AM','11HR','650','$month','$year','$departureonlyDate')",
         
         $insert6="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Dire Dawa','Adiss Abeba','$DepartureTime','12:30pM','12HR 30M','750','$month','$year','$departureonlyDate')",
         
         $insert7="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Bike','Meso','3:30AM','5:00AM','1HR 30M','150','$month','$year','$departureonlyDate')",
         
         $insert8="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Bike','Adama','3:30AM','10:00AM','7HR 30M','450','$month','$year','$departureonlyDate')",
         
         $insert9="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Bike','Mojo','3:30AM','10:30AM','8HR','500','$month','$year','$departureonlyDate')",
         
         $insert10="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Bike','Bishoftu','3:30AM','11:00AM','8HR 30M','550','$month','$year','$departureonlyDate')",
         
         $insert11="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Bike','Adiss Abeba','3:30AM','12:30AM','9HR','650','$month','$year','$departureonlyDate')",
         
         $insert12="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Meso','Adama','5:00AM','10:00AM','5HR','400','$month','$year','$departureonlyDate')",
         
         $insert13="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Meso','Mojo','5:00AM','10:30AM','5HR 30M','450','$month','$year','$departureonlyDate')",
         
         $insert14="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Meso','Bishoftu','5:00AM','11:00AM','6HR','500','$month','$year','$departureonlyDate')",
         
         $insert15="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Meso','Adiss Abeba','5:00AM','12:30AM','6HR 30M','550','$month','$year','$departureonlyDate')",
         
         
         $insert16="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Adama','Mojo','10:00AM','10:30AM','30M','250','$month','$year','$departureonlyDate')",
         
         $insert17="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Adama','Bishoftu','10:00AM','11:30AM','1HR','350','$month','$year','$departureonlyDate')",
         
         $insert18="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Adama','Adiss Abeba','10:00AM','12:30AM','2HR 30M','400','$month','$year','$departureonlyDate')",
         
         $insert19="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Mojo','Bishoftu','10:30AM','11:00AM','30M','250','$month','$year','$departureonlyDate')",
         
         $insert20="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Mojo','Adiss Abeba','10:30AM','12:30AM','2HR','350','$month','$year','$departureonlyDate')",
         
         $insert21="INSERT INTO `schedule`(`Date`, `weekday`, `dayno`, `DeparturePlace`, `ArivalPlace`, `DepartureTime`, `ArivalTime`, `journeyTime`, `price`, `Month`, `year`,`fulldate`) 
         VALUES ('$DepartureDate','$Weekday','$daynumber','Bishoftu','Adiss Abeba','11:30AM','12:30AM','1HR','250','$month','$year','$departureonlyDate')",
            );
           
               foreach ($queries as $insert) {
               mysqli_query($con, $insert); 
               }
               echo"
               <script>
               alert('All data inserted successfully!!!');
               </script>
               ";
               include('sideBar.php');
      }

      else{
         echo"
         <script>
         alert('please input valid departure Date and arrival Date!!!');
         </script>
         ";
         include('sideBar.php');

      }


        //mysqli_query($con,$insert) or die(mysqli_error($con));
      
         
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
 }
?>
