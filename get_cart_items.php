<?php
// UZIMANJE PHONES IZ DATABASE GDJE JE USERID === TRENUTNOM USERU ZA CARTBADGE I PRIKAZ CARTA
session_start();
require_once 'db_connect.php'; // Ensure this file connects to your database

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['id']; // Assuming the user ID is stored in session

$sql = "SELECT cart.quantity, phones.name, phones.price, phones.image, cart.product_id
        FROM cart 
        JOIN phones ON cart.product_id = phones.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$cartItems = [];
while ($row = $result->fetch_assoc()) {
    $cartItems[] = $row;
}

echo json_encode($cartItems);

$stmt->close();
$conn->close();
?>
