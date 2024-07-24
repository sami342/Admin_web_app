<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['role'])) {
    header("Location: adminlogin.php");
    exit();
}
 $con=mysqli_connect("localhost","root","") or die(mysqli_error());

 if($con){
     $db="create database if not exists train_ticket_booking";
     mysqli_query($con,$db) or die(mysqli_error($con));
     mysqli_select_db($con,"train_ticket_booking") or die(mysqli_error($con));
     $table="CREATE TABLE IF NOT EXISTS schedule (
        NO INT(11) NOT NULL AUTO_INCREMENT,
        Date VARCHAR(100) NOT NULL, 
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
        TextReference VARCHAR(100) NOT NULL,
        PaymentOption VARCHAR(100) NOT NULL,
        PRIMARY KEY (NO)
        );
";
       mysqli_query($con,$table) or die(mysqli_error($con));
       $search="select * from schedule";
       $result=mysqli_query($con,$search) or die(mysqli_error($con));
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
        <div class="menu" id="Meanu_bar">
            <a href="sideBar.php">
            <i class="fa-solid fa-home"></i>
            </a>
        </div>
        <nav class="title" id="title">
           <h3>All train ticket scheduel information</h3>
        </nav>

        <div class="icons">
        <a href="informuser.php">
            <i id="user" class="fa-solid fa-user"></i></a>
        </div>
        
    </header>

  
 <div class="details">
    <div class="scheuledetails">
        <div class="cardheader">
            <h2>2024</h2>
               <button class="btn" id="btn">Insert</button>
               <button class="btn" id="updatebtn">Update</button>
               <button class="btn" id="deletebtn">Delete</button>
           
               <form action="search_input.php" method="POST" encty>
               
                   <lable style="font-size:20px; margin-right:10px;">Departure: 
                        <select class="DeparturePlace" name="departure">
                            <option value=""></option>
                            <option value="Adiss Abeba">Adiss Abeba</option>
                            <option value="Bishoftu">Bishoftu</option>
                            <option value="Mojo">Mojo</option>
                            <option value="Adama">Adama</option>
                            <option value="Bika">Bika</option>
                            <option value="Dire Dawa">Dire Dawa</option>
                           
                        </select>
                    </lable> 



                    <lable style="font-size:20px;";>Arival: 
                        <select class="DeparturePlace" name="arival">
                            <option value=""></option>
                            <option value="Adiss Abeba">Adiss Abeba</option>
                            <option value="Bishoftu">Bishoftu</option>
                            <option value="Mojo">Mojo</option>
                            <option value="Adama">Adama</option>
                            <option value="Bika">Bika</option>
                            <option value="Dire Dawa">Dire Dawa</option>
                        </select>
                    </lable>

                 
                       
                       <button>
                          <i class="fa-solid fa-search" style="font-size:20px; padding:3px;"></i>
                       </button>
                
                   
                </form>
                
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
                            <th>Arival Time</th>
                            <th>Journey Time</th>
                            <th>Price</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Edit</th>
                            
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
                            <td>$price.ETB</td>
                            <td>$month</td>
                            <td>$year</td>
                            <td><a href='try.php?id=$no'><i class='fa-solid fa-edit' style='color:red'></i></a></td>
                            </tr>
                            ";
                   }
                   echo"</table>";
                 
           // }
            ?>
        
        </div>
       
    </div>
     
   
    <div class="popup">
        <div class="popup_content">
            <form id="scheduleForm" class="login_form" method="POST" action="insert.php">
                <div class="popup_title">
                    <h2>Insert Schedule</h2>
                    <i class="fa-solid fa-close" id="close"></i>
                </div>

                <p> 
                    <input type="datetime-local" class="month" name="departuredate" id="departure" required>
                    <label for="departure">Departure Date and Time</label>
                </p>


                <p>
                    <select class="DeparturePlace" name="departureplace" id="departureplace" style="width:150px; height:30px; border-radius: 6px; border-color: rgb(126, 213, 213); font-size:20px;" required>
                        <option value=""></option>
                        <option value="Adiss Abeba">Adiss Abeba</option>
                        <option value="Dire Dawa">Dire Dawa</option>
                    </select>
                    <label for="departureplace" style="font-size:20px;">Departure Place</label>
                </p>

                <p>
                    <select class="DeparturePlace" name="arrivalplace" id="arrivalplace" style="width:150px; height:30px; border-radius: 6px; border-color: rgb(126, 213, 213); font-size:20px;" required>
                        <option value=""></option>
                        <option value="Adiss Abeba">Adiss Abeba</option>
                        <option value="Dire Dawa">Dire Dawa</option>
                    </select>
                    <label for="arrivalplace" style="font-size:20px;">Arrival Place</label>
                </p>

                <p>
                    <input type="text" class="month" name="price" id="price" required>
                    <label for="price">Price</label>
                </p>

                <p>
                    <button type="submit" class="btn">Submit</button>
                    <button type="reset" class="btn">Clear</button>
                </p>
            </form>
        </div>
    </div>

   
<div class="popupupdate">
    <div class="popupcontentupdate">
        <div class="popup_title">
            <h2>Shift Schedule</h2>
            <i class="fa-solid fa-close" id="closeupdate"></i>
        </div>
        <form id="updateform" class="login_form" action="update.php" method="post">
            <p>
                <select class="DeparturePlace" name="shiftupdate">
                    <option value="" name=""></option>
                    <option value="back" name="back">Back one day</option>
                    <option value="no" name="no">No Schedule</option>
                </select>
                <label style="font-size:20px;">Update option</label>
            </p>
            <p>
                <input type="datetime-local" class="month" name="departuredate" id="departur">
                <label for="departur">Date</label>
            </p>
            <p>
               <button type="submit" class="btn" name="update">Update</button>
               <button type="reset" class="btn">Clear</button>
            </p>
        </form>
    </div>
</div>
</script>
    <div class="popupdelete">
      <div class="popupcontentdelete">
         <form action="delete.php" class="login_form" method="POST" encty>
           <div class="popup_title">
              <h2>Delete Schedule</h2>
              <i class="fa-solid fa-close" id="closedelete"></i>
            </div>
          <p>
                  <select class="chooseoption" name="chooseoption">
                            <option value="no" name="no">NO</option>
                        </select>
                        <label style="font-size:20px";>Update option</label>
                      
            </P>

            <p>
               
               <input type="text" class="month" name="deletevalue">
               <label for="">please enter value to Delete</label>
           </p>
            <p>
               <button type="submit" class="btn" name="delete">Delete</button>
            
               <button type="reset" class="btn">clear</button>
            </p>
            
         </form>


      </div>
      
    </div>
    <script src="try.js"></script>
     <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
        import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyB5oz8imtcv828m-KAX-keSOA2MnMirQjQ",
            authDomain: "booktrainticket-11f56.firebaseapp.com",
            projectId: "booktrainticket-11f56",
            storageBucket: "booktrainticket-11f56.appspot.com",
            messagingSenderId: "1055917221881",
            appId: "1:1055917221881:web:88e868a8c48dfb551cff28",
            measurementId: "G-WHV3T8W1SH"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        document.getElementById('scheduleForm').addEventListener('submit', async (e) => {
            e.preventDefault(); // Prevent the default form submission

            const departureDate = document.getElementById('departure').value.split('T')[0]; // Get only the date part

            // Data structure for seats with availability set to true
            const seats = Array.from({ length: 120 }, (_, index) => ({
                number: index + 1,
                available: true,  // Set availability to true
                status: "none"  // Set default status to "none"
            }));

            const data = {
                weekAvailability: {
                    [departureDate]: {
                        seats: seats
                    }
                }
            };

            try {
                // Add data to all 7 cargos
                for (let i = 1; i <= 7; i++) {
                    await setDoc(doc(db, `cargos/cargo${i}`), data, { merge: true });
                }
                alert('Data added successfully to all cargos');

                // Submit the form to insert.php
                document.getElementById('scheduleForm').submit();
            } catch (error) {
                console.error("Error adding document: ", error);
                alert('Error adding data');
            }
        });


    </script>

    
</body>
</html>