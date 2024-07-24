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

// Check if POST data is received
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];

    $stmt = $conn->prepare("INSERT INTO feedback (first_name, email, feedback, rating) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $first_name, $email, $feedback, $rating);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
