<?php

session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['role'])) {
    header("Location: adminlogin.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "train_ticket_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// // Get the current date
// if(isset($_POST['searchDate'])) {
//     $current_date = $_POST['2024-06-08'];
// } else {
//     $current_date = date('2024-06-08');
// }


// Get the current date
$current_date = date('Y-m-d');

$search1 = "select * from passenger";
$result1 = mysqli_query($conn, $search1) or die(mysqli_error($conn));

$num = mysqli_num_rows($result1) or die(mysqli_error($conn));
$newno = 1;
for ($r = 1; $r <= $num; $r++) {
    $row = mysqli_fetch_array($result1) or die(mysqli_error($conn));
    $no = $row['NO'];
    if ($no != $r) {
        $newno = $r;
        $upd = "update passenger set NO='$newno' where NO = '$no'";
        mysqli_query($conn, $upd) or die(mysqli_error($con));
    }
}

// Query to get counts based on age, sex, and class
$query = "SELECT 
            SUM(CASE WHEN Age < 21 THEN 1 ELSE 0 END) AS num_children,
            SUM(CASE WHEN sex = 'female' THEN 1 ELSE 0 END) AS num_females,
            SUM(CASE WHEN sex = 'male' THEN 1 ELSE 0 END) AS num_males,
            SUM(CASE WHEN class = 'Normal' THEN 1 ELSE 0 END) AS num_normal,
            SUM(CASE WHEN class = 'VIP' THEN 1 ELSE 0 END) AS num_vip
          FROM passenger WHERE Date='$current_date'";

$result = $conn->query($query);

if ($result->num_rows >= 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $num_children = $row["num_children"];
        $num_females = $row["num_females"];
        $num_males = $row["num_males"];
        $num_normal = $row["num_normal"];
        $num_vip = $row["num_vip"];
    }
} else {
    echo "0 results";
}

// Query to get cargo and seats data
$query_cargo = "SELECT cargo, COUNT(*) AS num_seats_taken FROM passenger WHERE Date='$current_date' GROUP BY cargo";
$result_cargo = $conn->query($query_cargo);

$cargo_labels = [];
$num_seats_taken_data = [];

if ($result_cargo->num_rows >=0) {
    // Output data of each row
    while ($row = $result_cargo->fetch_assoc()) {
        $cargo_labels[] = $row["cargo"];
        $num_seats_taken_data[] = $row["num_seats_taken"];
    }
} else {
    echo "0 results";
}


// Query to count the number of passengers for each departure place to arrival place combination based on the current date
$query_departure_arrival_count = "SELECT DeparturePlace, ArrivalPlace, COUNT(*) AS passenger_count FROM passenger WHERE Date='$current_date' GROUP BY DeparturePlace, ArrivalPlace";
$result_departure_arrival_count = $conn->query($query_departure_arrival_count);

$departure_places = [];
$arrival_places = [];
$passenger_counts = [];

if ($result_departure_arrival_count->num_rows >= 0) {
    // Output data of each row
    while ($row = $result_departure_arrival_count->fetch_assoc()) {
        $departure_places[] = $row["DeparturePlace"];
        $arrival_places[] = $row["ArrivalPlace"];
        $passenger_counts[] = $row["passenger_count"];
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mainAdmin.css">
    <link rel="stylesheet" href="css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <div class="menu">
        <a href="sideBar.php"><i class="fas fa-home"></i></a>
    </div>

    <nav class="title" id="titlee">
        <h3>General Report</h3>
    </nav>

    <div class="icons">
    <div class="profile-picture" id="user" onclick="showOptions()">
        <img src="image/image5.jpg" alt="Profile Picture">
    </div>

    <div id="options" class="options"> 
        <ul>
            <li><a href="#">Change Password</a></li>
            <li><a href="#">Change Profile</a></li>
        </ul>
    </div>
</div>
</header>


<div class="report_title">
        <div class="report_title_detail">
            <div class="cardheader">
                <h2>Todays<span>&nbsp;Report</span></h2>
                <label>Month:
                    <input id="searchDate" class="month" type="Date"><i id="searchButton" class="fa-solid fa-search" style="margin: 10px;"></i>
                </label>
            </div>
        </div>
    </div>


     <!-- Form for submitting date -->
     <form id="searchForm" action="specific_report.php" method="GET" style="display:none;">
        <input type="hidden" name="date" id="hiddenDate">
    </form>

    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                var selectedDate = $('#searchDate').val();
                if (selectedDate) {
                    // Send date using form submission
                    $('#hiddenDate').val(selectedDate);
                    $('#searchForm').submit();
                } else {
                    alert('Please select a date');
                }
            });
        });
    </script>
    
 


<div class="report">
    <div class="reportdetails">
        <div class="cardheader">
            <h2><i class="fa-solid fa-person"></i></h2>
            <label>BOYS
            </label><br>
            <Strong><?php echo $num_males; ?></Strong>
        </div>
    </div>

    <div class="reportdetails">
        <div class="cardheader">
            <h2><i class="fa-solid fa-female"></i></h2>
            <label>GIRLS
            </label>
            <Strong><?php echo $num_females; ?></Strong>
        </div>
    </div>

    <div class="reportdetails">
        <div class="cardheader">
            <h2><i class="fa-solid fa-child"></i></h2>
            <label>CHILD
            </label>
            <Strong><?php echo $num_children; ?></Strong>
        </div>
    </div>

    <!-- Display counts based on class -->
    <div class="reportdetails">
        <?php if ($num_normal > 0): ?>
            <div class="cardheader">
                <h2><i class="fa-solid fa-id-card"></i></h2>
                <label>NORMAL
                </label>
                <Strong><?php echo $num_normal; ?></Strong>
            </div>
        <?php endif; ?>
    </div>

    <div class="reportdetails">
        <?php if ($num_vip > 0): ?>
            <div class="cardheader">
                <h2><i class="fa-solid fa-crown"></i></h2>
                <label>VIP
                </label>
                <Strong><?php echo $num_vip; ?></Strong>
            </div>
        <?php endif; ?>
    </div>

    <div class="reportdetails">
        <div class="cardheader">
            <h2><i class="fa-solid fa-people-line"></i></h2>
            <label>TOTAL
            </label>
            <Strong><?php echo ($num_males + $num_females); ?></Strong>
        </div>
    </div>
</div>

<div style="width: 50%; float: left;">
    <canvas id="myChart"></canvas>
</div>

<div style="width: 50%; float: left;">
    <canvas id="cargoChart"></canvas>
</div>

<div style="width: 800px; margin: 0 auto;">
     <canvas id="passengerCountChart"></canvas>
 </div>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Boys', 'Girls', 'Children', 'Normal', 'VIP'],
            datasets: [{
                label: 'Counts',
                data: [<?php echo $num_males; ?>, <?php echo $num_females; ?>, <?php echo $num_children; ?>, <?php echo $num_normal; ?>, <?php echo $num_vip; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxCargo = document.getElementById('cargoChart').getContext('2d');
    var cargoChart = new Chart(ctxCargo, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($cargo_labels); ?>,
            datasets: [{
                label: 'Seats Taken',
                data: <?php echo json_encode($num_seats_taken_data); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    <?php if (!empty($departure_places) && !empty($arrival_places) && !empty($passenger_counts)): ?>

   // Get the data from PHP

       var departure_places = <?php echo json_encode($departure_places); ?>;
        var arrival_places = <?php echo json_encode($arrival_places); ?>;
        var passenger_counts = <?php echo json_encode($passenger_counts); ?>;

        // Create a line chart
        var ctx = document.getElementById('passengerCountChart').getContext('2d');
        var passengerCountChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: departure_places.map((place, index) => place + ' to ' + arrival_places[index]),
                datasets: [{
                    label: 'Passenger Count',
                    data: passenger_counts,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        <?php endif; ?>

        
</script>

</body>

<script src="report.js"></script>
</html>
