<?php
// BRISANJE USERA IZ DATABASE
require_once 'db_connect.php';

// Retrieve user ID from POST request
$userId = isset($_POST['userId']) ? (int)$_POST['userId'] : 0;

if ($userId) {
    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete the user from any related tables first (if applicable, e.g., orders, cart)
        // In this case, if there is no direct relation, skip this step.

        // Now delete user from the users table
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Commit transaction
            $conn->commit();
            echo json_encode(["success" => true, "message" => "User deleted successfully."]);
        } else {
            // Rollback transaction
            $conn->rollback();
            echo json_encode(["success" => false, "message" => "User not found."]);
        }
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo json_encode(["success" => false, "message" => "Failed to delete user: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid user ID."]);
}

$conn->close();
?>
