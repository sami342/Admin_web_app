<?php

$no=$_GET['id'];

$da="2024-02-29T15:30";

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
       $search="select * from schedule where NO=$no";
       $result=mysqli_query($con,$search) or die(mysqli_error($con));
       $num=mysqli_num_rows($result) or die(mysqli_error($con));
       for($r=1;$r<=$num;$r++){
       $row=mysqli_fetch_array($result) or die(mysqli_error($con));
              $no=$row['NO'];
              $date=$row['Date'];
              $WeekDay=$row['weekday'];
              $DayNO=$row['dayno'];
              $departureP=$row['DeparturePlace'];
              $arivalP=$row['ArivalPlace'];
              $departureT=$row['DepartureTime'];
              $arivalT=$row['ArivalTime'];
              $journey=$row['journeyTime'];
              $price=$row['price'];
              $month=$row['Month'];  
              $year=$row['year'];  

       }
       if($DayNO<10){
        $DayNO="0".$DayNO;
       }
       if($month=="Jan")$monthnumber=1;
       if($month=="Feb")$monthnumber=2;
       if($month=="Mar")$monthnumber=3;
       if($month=="Apr")$monthnumber=4;
       if($month=="May")$monthnumber=5;
       if($month=="Jun")$monthnumber=6;
       if($month=="Jul")$monthnumber=7;
       if($month=="Aug")$monthnumber=8;
       if($month=="Sep")$monthnumber=9;
       if($month=="Oct")$monthnumber=10;
       if($month=="Nov")$monthnumber=11;
       if($month=="Dec")$monthnumber=12;

       if($monthnumber<10){
        $monthnumber="0".$monthnumber;
       }

       $showdate=$year.$monthnumber.$DayNO." ".$departureT;
     //  $formatted_datetime=date('y-m-d\TH:i',strtotime($showdate));
       $formatted_datetime1=date('Y-m-d\TH:i',strtotime($showdate));
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
  
  <div class="update">
      <div class="contentupdate">
      <div class="popup_title">
        <a href="schedule.php"> <i class="fa-solid fa-arrow-left-long"></i></a>
              <h2>update Schedule</h2>
            
            </div>
           
         <form action="updatetry.php"  method="POST" encty>
         <input type="hidden" name="no" value="<?php echo $no?>">
            <?php        
            echo'<input type="datetime-local" class="month" name="departuredate" id="updatetime" style="width:190px;border-radius: 6px; margin:10px 10px;" value="'.$formatted_datetime1.'">
            <label for="" style="font-size:20px;">Departure Date and Arival Date </label>'
            ?>

          
            <p>
                
                        <select class="DeparturePlace"  name="departureplace" style="width:190px; height:30px;  border-radius: 6px; border-color: rgb(126, 213, 213); font-size:20px;">
                            <option value="<?php echo$departureP;?>"><?php echo$departureP;?></option>
                            <option value="Adiss Abeba">Adiss Abeba</option>
                            <option value="Bishoftu">Bishoftu</option>
                            <option value="Mojo">Mojo</option>
                            <option value="Adama">Adama</option>
                            <option value="Bika">Bika</option>
                            <option value="Dire Dawa">Dire Dawa</option>
                        </select>
                        <lable style="font-size:20px;">Departure Place<label>
                
            </p>

            <p>

                        <select class="DeparturePlace" name="arivalplace" style="width:190px; height:30px;  border-radius: 6px; border-color: rgb(126, 213, 213); font-size:20px;">
                            <option value="<?php echo"$arivalP";?>"><?php echo$arivalP;?></option>
                            <option value="Adiss Abeba">Adiss Abeba</option>
                            <option value="Bishoftu">Bishoftu</option>
                            <option value="Mojo">Mojo</option>
                            <option value="Adama">Adama</option>
                            <option value="Bika">Bika</option>
                            <option value="Dire Dawa">Dire Dawa</option>
                        </select>
                        <lable style="font-size:20px;">Arival place </label>
            </p>

            <p>
               
               <input type="text" class="month" name="journeyTime" value="<?php echo"$journey";?>">
               <label for="">journey Time</label>
           </p>

            <p>
               
                <input type="text" class="month" name="price" value="<?php echo"$price";?>">
                <label for="">price</label>
            </p>
        

            <p>
               <button type="submit" class="btn" name="update">Update</button>
            
               <button type="reset" class="btn">clear</button>
            </p>
          

            
         </form>
      </div>
    </div>
        
    <script>
        let btn = document.querySelector('#btn');
        let sideBar = document.querySelector('.side_bar');
        btn.onclick = function() {
            sideBar.classList.toggle('active');
        };
    </script>
<script src="check.js"></script>
</body>
</html>