<?php
// DOHVACANJE PHONE IZ DATABASE ZA EDIT KAO ADMIN
include 'db_connect.php';

$response = array('success' => false);

if (isset($_GET['id'])) {
    $phoneId = intval($_GET['id']);
    
    $stmt = $conn->prepare("SELECT * FROM phones WHERE id = ?");
    $stmt->bind_param("i", $phoneId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $phone = $result->fetch_assoc();
        $response['success'] = true;
        $response['phone'] = $phone;
    } else {
        $response['message'] = 'Phone not found.';
    }
    
    $stmt->close();
}

$conn->close();
echo json_encode($response);
?>
