<?php
//DODAVANJE PHONE U CART U DATABASE
session_start();
include 'db_connect.php';

$response = array('success' => false, 'message' => '');

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $userId = $_SESSION['id'];
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    // Check if the item is already in the cart
    $sql = "SELECT id FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Item already in the cart, just update the quantity
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    } else {
        // Item not in the cart, insert a new record
        $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Item added to cart successfully!';
    } else {
        $response['message'] = 'Failed to add item to cart.';
    }

    $stmt->close();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
