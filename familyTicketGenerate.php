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

$ticket_reference = $_GET['ticket_reference'];

// Prepare SQL statement to retrieve passengers with the given ticket reference
$sql_passenger = "SELECT * FROM passenger WHERE TextReference LIKE '%$ticket_reference%'";
$result_passenger = $conn->query($sql_passenger);

$response = array();

if ($result_passenger->num_rows > 0) {
    // Fetch associative array
    while ($row_passenger = $result_passenger->fetch_assoc()) {
        $response[] = $row_passenger;
    }
    // Output JSON response
    echo json_encode($response);
} else {
    // If no rows found for the provided ticket reference
    $response['message'] = "No passengers found for the provided ticket reference";
    echo json_encode($response);
}

// Close connection
$conn->close();

return;
?>
