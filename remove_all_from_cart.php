<?php
// BRISANJE SVIH PHONES IZ CARTA USERA (DATABASE-A)

// Start session to access session variables
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// Access user ID from session
$userId = $_SESSION['id'];

// Include database connection
require_once 'db_connect.php';

// Prepare SQL to remove all items for the logged-in user
$sql = "DELETE FROM cart WHERE user_id = ?";

// Use prepared statement for safety
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'All items removed from cart']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to remove items from cart']);
}

$stmt->close();
$conn->close();
?>
