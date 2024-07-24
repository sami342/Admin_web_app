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


// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if all required fields are present
if (isset($data['FirstName']) && isset($data['MiddleName']) && isset($data['LastName']) &&
    isset($data['Age']) && isset($data['Sex']) && isset($data['DeparturePlace']) &&
    isset($data['ArrivalPlace']) && isset($data['Class']) && isset($data['Cargo']) &&
    isset($data['Seat']) && isset($data['Phone']) && isset($data['Date']) &&
    isset($data['TextReference']) && isset($data['Price']) && isset($data['PaymentOption'])) {

    // Prepare the SQL statement
    $stmt = $conn->prepare('INSERT INTO passenger (FirstName, MiddleName, LastName, Age, Sex, DeparturePlace, ArrivalPlace, Class, Cargo, Seat, Phone, Date, Price, TextReference, PaymentOption) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssisssssssssss', 
        $data['FirstName'], $data['MiddleName'], $data['LastName'], $data['Age'], $data['Sex'],
        $data['DeparturePlace'], $data['ArrivalPlace'], $data['Class'], $data['Cargo'],
        $data['Seat'], $data['Phone'], $data['Date'], $data['Price'], $data['TextReference'], $data['PaymentOption']
    );

    // Execute the statement
    if ($stmt->execute()) {
        $response = ['message' => 'Passenger added successfully'];
    } else {
        $response = ['message' => 'Failed to add passenger'];
        http_response_code(500);
    }

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

    // Close statement
    $stmt->close();

} else {
    $response = ['message' => 'Invalid input'];
    http_response_code(400);
}

// Output JSON response
echo json_encode($response);

// Close connection
$conn->close();

?>
