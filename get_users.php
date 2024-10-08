<?php
// UCITAVANJE USERA KAO ADMIN
session_start();
include('db_connect.php');

// Check if user is logged in as admin
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Admin not logged in']);
    exit;
}

$response = ['success' => false, 'users' => []];

$sql = "SELECT id, username, email, balance FROM users"; // Adjust table and column names as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    $response['success'] = true;
    $response['users'] = $users;
} else {
    $response['message'] = 'No users found';
}

$conn->close();
echo json_encode($response);
?>
