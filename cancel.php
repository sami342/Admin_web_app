<?php

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

// Get parameters from the request
$phone_number = $_GET['phone_number'];
$first_name = $_GET['first_name'];
$ticket_reference= $_GET['ticket_reference'];

// Create the cancleticket table if it doesn't exist
$table_cancleticket = "CREATE TABLE IF NOT EXISTS cancleticket (
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
)";
if ($conn->query($table_cancleticket) === TRUE) {
    echo "<script>alert('Cancel ticket table created successfully');</script>";
} else {
    echo "Error creating cancel ticket table: " . $conn->error . "<br>";
}

// Prepare SQL statement to read the passenger data
$sql_read = "SELECT * FROM passenger WHERE FirstName='$first_name' AND TextReference='$ticket_reference'";
$result = $conn->query($sql_read);

if ($result->num_rows > 0) {
    // Output data of each row and insert into cancleticket table
    while($row = $result->fetch_assoc()) {
        $first_name = $row["FirstName"];
        $middle_name = $row["MiddleName"];
        $last_name = $row["LastName"];
        $age = $row["Age"];
        $sex = $row["Sex"];
        $departure_place = $row["DeparturePlace"];
        $arival_place = $row["ArrivalPlace"];
        $class = $row["Class"];
        $cargo = $row["Cargo"];
        $seat = $row["Seat"];
        $phone = $row["Phone"];
        $date = $row["Date"];
        $text_reference = $row["TextReference"];

        $sql_insert = "INSERT INTO cancleticket (FirstName, MiddleName, LastName, Age, Sex, DeparturePlace, ArivalPlace, Class, Cargo, Seat, Phone, Date, TextReference) 
                       VALUES ('$first_name', '$middle_name', '$last_name', $age, '$sex', '$departure_place', '$arival_place', '$class', '$cargo', '$seat', '$phone', '$date', '$text_reference')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "New record inserted successfully in cancleticket table<br>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
} else {
    echo "No passenger found with the given details<br>";
}

// Prepare SQL statement to delete the passenger
$sql_delete = "DELETE FROM passenger WHERE Phone='$phone_number' AND FirstName='$first_name' AND TextReference='$ticket_reference'";
if ($conn->query($sql_delete) === TRUE) {
    // If the passenger is successfully deleted
    $response['message'] = "Passenger deleted successfully";
    echo json_encode($response);

    // Update the NO column to maintain sequential order
    $search1 = "SELECT * FROM passenger";
    $result1 = mysqli_query($conn, $search1) or die(mysqli_error($conn));

    $num = mysqli_num_rows($result1) or die(mysqli_error($conn));
    $newno = 1;
    for ($r = 1; $r <= $num; $r++) {
        $row = mysqli_fetch_array($result1) or die(mysqli_error($conn));
        $no = $row['NO'];
        if ($no != $r) {
            $newno = $r;
            $upd = "UPDATE passenger SET NO='$newno' WHERE NO = '$no'";
            mysqli_query($conn, $upd) or die(mysqli_error($conn));
        }
    }
} else {
    // If an error occurs during deletion
    $response['message'] = "Error deleting passenger: " . $conn->error;
    echo json_encode($response);
}

// Close connection
$conn->close();

?>
