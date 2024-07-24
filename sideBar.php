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
    <script language="javascript" type="text/javascript">
        window.history.forward();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethio-Dijubuti Railway Admin Panel</title>
    <link rel="stylesheet" href="sideBar.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>
<body>
    <div class="side_bar">
        <div class="top">
            <div class="logo">
                <i class="fa-solid fa-train-subway"></i>
                <span>&nbsp;Ethio-Dijubuti Railway</span>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>

        <div class="user">
            <img src="image/addis train.jpg" alt="Admin Image" class="user-img">
            <div>
                <p class="bold">Manager</p>
                <p>Admin</p>
            </div>
        </div>
        <ul>
            <li>
                <a href="#">
                    <i class="fa-solid fa-home"></i>
                    <span class="nav_item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>

            <li>
                <a href="schedule.php">
                    <i class="fa-solid fa-list"></i>
                    <span class="nav_item">Schedule</span>
                </a>
                <span class="tooltip">Schedule</span>
            </li>

            <li>
                <a href="passenger.php">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav_item">Passenger</span>
                </a>
                <span class="tooltip">Passenger</span>
            </li>

            <li>
                <a href="notification.php">
                    <i class="fa-solid fa-bell"></i>
                    <span class="nav_item">Notification</span>
                </a>
                <span class="tooltip">Notification</span>
            </li>

            <li>
                <a href="report1.php">
                    <i class="fa-solid fa-circle-info"></i>
                    <span class="nav_item">Report</span>
                </a>
                <span class="tooltip">Report</span>
            </li>

        
            <li>
                <a href="Read_feedback.php">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span class="nav_item">Feedback</span>
                </a>
                <span class="tooltip">Feedback</span>
            </li>

            <li>
                <a href="adminlogin.php">
                    <i class="fa-solid fa-sign-out"></i>
                    <span class="nav_item">Sign out</span>
                </a>
                <span class="tooltip">Sign out</span>
            </li>
       </ul> 
    </div>

    <div class="main_content">
        <div class="container">
            <div>
                <h1>Welcome to Ethio-Dijubuti Train Ticket Admin Control!</h1>
            </div>
        </div>

        <div class="cards-list">
            <div class="card">
                <div class="card_image">
                    <img src="image/meiso.jpg" alt="Lebu station" class="user-img">
                </div>
                <div class="card_title">
                    <a href="citydetail.php?name=Adiss%20Abeba"><p>Lebu station</p></a>
                    <h2>Addis Abeba</h2>
                </div>
            </div>
            <div class="card">
                <div class="card_image">
                    <img src="image/mojo.png" alt="Melka station" class="user-img">
                </div>
                <div class="card_title">
                    <a href="citydetail.php?name=Dire%20Dawa"><p>Melka station</p></a>
                    <h2>Dire Dawa</h2>
                </div>
            </div>
            <div class="card">
                <div class="card_image">
                    <img src="image/adama.jpg" alt="Adama station" class="user-img">
                </div>
                <div class="card_title">
                    <a href="citydetail.php?name=Adama"><p>Adama station</p></a>
                    <h2>Adama</h2>
                </div>
            </div>
            <div class="card">
                <div class="card_image">
                    <img src="image/dire.jpg" alt="Bishoftu station" class="user-img">
                </div>
                <div class="card_title">
                    <a href="citydetail.php?name=Bishoftu"><p>Bishoftu station</p></a>
                    <h2>Bishoftu</h2>
                </div>
            </div>
            <div class="card">
                <div class="card_image">
                    <img src="image/in.jpg" alt="Bike station" class="user-img">
                </div>
                <div class="card_title">
                    <a href="citydetail.php?name=Modjo"><p>Bike station</p></a>
                    <h2>Bike</h2>
                </div>
            </div>
            <div class="card">
                <div class="card_image">
                    <img src="image/addis train.jpg" alt="Meso station" class="user-img">
                </div>
                <div class="card_title">
                    <a href="citydetail.php?name=Meso"><p>Meso station</p></a>
                    <h2>Meiso</h2>
                </div>
            </div>
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
