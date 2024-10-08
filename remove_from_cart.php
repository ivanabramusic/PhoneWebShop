<?php
// BRISANJE JEDNOG PHONEA IZ CARTA
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_POST['productId'])) {
    $productId = intval($_POST['productId']);
    $userId = $_SESSION['id'];

    // Debug output
    error_log("Product ID: $productId");
    error_log("User ID: $userId");

    // Database connection
    require_once 'db_connect.php';

    // Check the current quantity of the item in the cart
    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param('ii', $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentQuantity = intval($row['quantity']);

        if ($currentQuantity > 1) {
            // If more than 1, decrease the quantity by 1
            $stmt = $conn->prepare("UPDATE cart SET quantity = quantity - 1 WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param('ii', $userId, $productId);
            $stmt->execute();
        } else {
            // If quantity is 1, remove the item from the cart
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param('ii', $userId, $productId);
            $stmt->execute();
        }

        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in or invalid request']);
}
?>
