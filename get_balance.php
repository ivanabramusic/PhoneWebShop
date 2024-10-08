<?php
// DOBIVANJE BALANCE USERA IZ DATABASEA
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$response = [
    'success' => true,
    'balance' => number_format($_SESSION['balance'], 2)  // Properly formatted balance
];

echo json_encode($response);
?>
