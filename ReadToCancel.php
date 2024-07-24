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
$ticket_reference = $_GET['ticket_reference'];

// Prepare SQL statement
$sql = "SELECT * FROM passenger WHERE Phone='$phone_number' AND FirstName ='$first_name' AND TextReference='$ticket_reference'";
$result = $conn->query($sql);

$response = array();

if ($result->num_rows > 0) {
    // Fetch associative array
    while ($row = $result->fetch_assoc()) {
        $response[] = $row;
    }
    // Output JSON response
    echo json_encode($response);

} else {
    // If no rows found
    $response['message'] = "No data found";
    echo json_encode($response);
}

// Close connection
$conn->close();

?>
