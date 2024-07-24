<?php
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$serviceAccount = ServiceAccount::fromJsonFile('C:\xampp1\htdocs\finalProjectTRain\booktrainticket-11f56-firebase-adminsdk-8riap-30659c0e13.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$firestore = $firebase->createFirestore();
$database = $firestore->database();

// Create a collection named 'seats' and add data to it
$seatData = [
    'seatNumber' => 'A1',
    'isAvailable' => true,
    'price' => 50,
    'location' => 'Front Row'
];

// Add document to Firestore
$database->collection('seats')->add($seatData);

echo "Document added to Firestore successfully.";
