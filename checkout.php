<?php
// KUPOVINA PHONES IZ CARTA
session_start();
require_once 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$userId = $_SESSION['id'];

// Fetch the user's balance from the session
$userBalance = $_SESSION['balance'];

// Fetch cart items for this user
$sql = "SELECT cart.product_id, cart.quantity, phones.price, phones.quantity AS stock_quantity, phones.name
        FROM cart 
        JOIN phones ON cart.product_id = phones.id
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$cartTotal = 0;
$cartItems = [];

while ($row = $result->fetch_assoc()) {
    $productId = $row['product_id'];
    $cartQuantity = $row['quantity'];
    $productPrice = $row['price'];
    $stockQuantity = $row['stock_quantity'];
    $productName = $row['name'];

    // Calculate total for this item
    $cartTotal += $productPrice * $cartQuantity;

    // Check if stock is sufficient
    if ($cartQuantity > $stockQuantity) {
        echo json_encode(['success' => false, 'message' => 'Insufficient stock for ' . $productName]);
        exit;
    }

    $cartItems[] = [
        'product_id' => $productId,
        'quantity' => $cartQuantity
    ];
}

// Check if the user has enough balance
if ($userBalance < $cartTotal) {
    echo json_encode(['success' => false, 'message' => 'Insufficient balance']);
    exit;
}

// All checks passed: proceed with checkout

// Deduct the total price from the user's balance
$newBalance = $userBalance - $cartTotal;
$_SESSION['balance'] = $newBalance;

$updateBalanceSql = "UPDATE users SET balance = ? WHERE id = ?";
$updateBalanceStmt = $conn->prepare($updateBalanceSql);
$updateBalanceStmt->bind_param("di", $newBalance, $userId);
$updateBalanceStmt->execute();

// Update the stock for each product
foreach ($cartItems as $item) {
    $updateStockSql = "UPDATE phones SET quantity = quantity - ? WHERE id = ?";
    $updateStockStmt = $conn->prepare($updateStockSql);
    $updateStockStmt->bind_param("ii", $item['quantity'], $item['product_id']);
    $updateStockStmt->execute();
}

// Clear the user's cart
$clearCartSql = "DELETE FROM cart WHERE user_id = ?";
$clearCartStmt = $conn->prepare($clearCartSql);
$clearCartStmt->bind_param("i", $userId);
$clearCartStmt->execute();

echo json_encode(['success' => true]);

$stmt->close();
$conn->close();
?>
