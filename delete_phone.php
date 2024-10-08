<?php
// BRISANJE PHONE IZ DATABASE KAO ADMIN
require_once 'db_connect.php';

// Retrieve phone ID from POST request
$phoneId = isset($_POST['phoneId']) ? (int)$_POST['phoneId'] : 0;

if ($phoneId) {
    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete phone from the cart table first
        $stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
        $stmt->bind_param("i", $phoneId);
        $stmt->execute();

        // Now delete phone from the phones table
        $stmt = $conn->prepare("DELETE FROM phones WHERE id = ?");
        $stmt->bind_param("i", $phoneId);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Commit transaction
            $conn->commit();
            echo json_encode(["success" => true, "message" => "Phone deleted successfully."]);
        } else {
            // Rollback transaction
            $conn->rollback();
            echo json_encode(["success" => false, "message" => "Phone not found."]);
        }
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "Failed to delete phone: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid phone ID."]);
}

$conn->close();
?>
