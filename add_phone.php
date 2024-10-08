<?php
// DODAVANJE PHONE U DATABASE KAO ADMIN
session_start();
include('db_connect.php');

// Check if user is logged in as admin
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Admin not logged in']);
    exit;
}

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    if (empty($name) || empty($price) || empty($quantity) || empty($image)) {
        $response['message'] = 'All fields are required.';
    } else {
        // Prepare and execute the SQL statement
        $sql = "INSERT INTO phones (name, price, quantity, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdis", $name, $price, $quantity, $image);

        if ($stmt->execute()) {
            $response['success'] = true;
        } else {
            $response['message'] = 'Error: ' . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}

echo json_encode($response);
?>
