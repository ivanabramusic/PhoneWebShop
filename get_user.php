<?php
// UZIMANJE USERA ZA EDIT KAO ADMIN
include 'db_connect.php';

$response = array('success' => false);

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT id, name, surname, username, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $response['success'] = true;
        $response['user'] = $user;
    } else {
        $response['message'] = 'User not found.';
    }
    
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
