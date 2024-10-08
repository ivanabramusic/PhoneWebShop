<?php
// DOHVACANJE SVIH PHONES IZ DATABASE
session_start();
include('db_connect.php');

// Check if user is logged in as admin
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Admin not logged in']);
    exit;
}

$response = ['success' => false, 'phones' => []];

$sql = "SELECT id, name, quantity, price, image FROM phones"; // Adjust table and column names as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $phones = [];
    while ($row = $result->fetch_assoc()) {
        $phones[] = $row;
    }
    $response['success'] = true;
    $response['phones'] = $phones;
} else {
    $response['message'] = 'No phones found';
}

$conn->close();
echo json_encode($response);
?>
