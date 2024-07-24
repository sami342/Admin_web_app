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
           <h3>all passenger ticket booking information</h3>
        </nav>

        <div class="icons">
            <i id="user" class="fa-solid fa-user"></i>
        </div>
    </header>
 <div class="details">
    <div class="scheuledetails">
        <div class="cardheader">
            <h2><?php
                    $con=mysqli_connect("localhost","root","") or die(mysqli_error());

                    if($con){
                        $db="create database if not exists Train_Ticket_booking";
                        mysqli_query($con,$db) or die(mysqli_error($con));
                        mysqli_select_db($con,"Train_Ticket_booking") or die(mysqli_error($con));
                            $search="select * from passenger";       

                        $result=mysqli_query($con,$search) or die(mysqli_error($con));
                        if($search==NULL){
                            echo"
                            <script>
                            alert('There is no data registered');
                            </script>
                            ";
                        }
                        else{
                            $row=mysqli_fetch_array($result) or die(mysqli_error($con));
                            $Date=$row['Date'];
                           

                        }
                    }
              
            ?>
            <span>&nbsp;2024</span></h2>
            <div class="search">
                <form action="passenger_search.php" method="POST" encty>
                    <input name="phNO" type="search" placeholder="search here">
                    <button>
                            <i class="fa-solid fa-search"></i>
                    </button>
                      
                </form>
            </div>
           
        </div>
        <?php
            $con=mysqli_connect("localhost","root","") or die(mysqli_error());

            if($con){
                $db="create database if not exists train_ticket_booking";
                mysqli_query($con,$db) or die(mysqli_error($con));
                mysqli_select_db($con,"train_ticket_booking") or die(mysqli_error($con));
                $check_table_query = "SHOW TABLES LIKE 'passenger'";
                $result = mysqli_query($con, $check_table_query);
                if(mysqli_num_rows($result) == 0) {
                    $tabel="CREATE TABLE IF NOT EXISTS passenger (
                        NO INT AUTO_INCREMENT PRIMARY KEY,
                        FirstName VARCHAR(255),
                        MiddleName VARCHAR(255),
                        LastName VARCHAR(255),
                        Age INT,
                        Sex VARCHAR(10),
                        DeparturePlace VARCHAR(255),
                        ArivalPlace VARCHAR(255),
                        Class VARCHAR(50),
                        Cargo VARCHAR(50),
                        Seat VARCHAR(50),
                        Phone VARCHAR(15),
                        Date DATE,
                        TextReference VARCHAR(255)
                    );
                    ";
                    mysqli_query($con,$tabel) or die(mysqli_error($con));
                }
               
                $search="select * from passenger";       

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
                    <capLion><b>Passengers</b></capLion>
        
                        <tr>
                            <th>NO</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                           
                            <th>Sex</th>
                            <th>Departure place</th>
                            <th>Arival place</th>
                            <th>Class</th>
                            <th>Cargo</th>
                            <th>Seat</th>
                        
                            <th>Ticket Refrence</th>
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
                             $textRef=$row['TextReference'];
                            
                        
                  
                   echo"
                            <tr>
                            <td>$no</td>
                            <td>$Fname</td>
                            <td>$Lname</td>
                            <td>$sex</td>
                            <td>$departureP</td>
                            <td>$arivalP</td>
                            <td>$class</td>
                            <td>$cargo</td>
                            <td>$seat</td>  
                            <td>$textRef</td>  
                            </tr>
                            ";
                    }
                }
                   echo"</table>";
                
            }
        ?>
    </div>    
</div>
</body>
</html>
