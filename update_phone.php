<?php
// UPDATE PHONE U DATABASE KAO ADMIN
include 'db_connect.php';

$response = array('success' => false);

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity']) && isset($_POST['image'])) {
    $phoneId = intval($_POST['id']);
    $name = $_POST['name'];
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $image = $_POST['image'];
    
    $stmt = $conn->prepare("UPDATE phones SET name = ?, price = ?, quantity = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sdisi", $name, $price, $quantity, $image, $phoneId);
    
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Failed to update phone.';
    }
    
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
