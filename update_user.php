<?php
//UPDATE USER KAO ADMIN
include 'db_connect.php';

$response = array('success' => false);

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['username'])) {
    $userId = intval($_POST['id']);
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    $stmt = $conn->prepare("UPDATE users SET name = ?, surname = ?, email = ?, username = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $surname, $email, $username, $userId);
    
    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Failed to update user.';
    }
    
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
