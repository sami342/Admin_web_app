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
  
  <div class="update">
      <div class="contentupdate">
      <div class="popup_title">
        <a href="schedule.php"> <i class="fa-solid fa-arrow-left-long"></i></a>
              <h2>update Schedule</h2>
            
            </div>
           
         <form action="update.php"  method="POST" encty>
        <input type="hidden" value="<?php echo $no?>">
          
            <p> 
                <input type="datetime-local" class="month" name="departuredate" id="departur" value="22-13-2024">
                <label for="">Departure Date and Time</label>
                
            </p>

            <p>
                
                <input type="datetime-local" class="month" name="arivaldate">
                <label for="">Arival Date and Time</label>
            </p>

            <p>
                
                        <select class="DeparturePlace" name="departureplace" style="width:190px; height:30px;  border-radius: 6px; border-color: rgb(126, 213, 213); font-size:20px;">
                            <option value=""></option>
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
                            <option value="hello"></option>
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
               
                <input type="text" class="month" name="price" value="">
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
</body>
</html>