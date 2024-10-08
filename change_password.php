<?php
// PROMJENI PASSWORD KAO USER
session_start();
include 'db_connect.php'; // Include your database connection


$response = array('success' => false, 'error' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        $userId = $_SESSION['id']; // Assuming you have the user's ID stored in session
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        // Check if new password and confirm password match
        if ($newPassword !== $confirmPassword) {
            $response['error'] = 'New password and confirmation do not match.';
        } else {
            // Fetch current password from the database
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];

                // Verify current password
                if (password_verify($currentPassword, $hashedPassword)) {
                    // Hash new password
                    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    // Update the password in the database
                    $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $updateStmt->bind_param("si", $newHashedPassword, $userId);

                    if ($updateStmt->execute()) {
                        $response['success'] = true;
                    } else {
                        $response['error'] = 'Failed to update password.';
                    }

                    $updateStmt->close();
                } else {
                    $response['error'] = 'Current password is incorrect.';
                }
            } else {
                $response['error'] = 'User not found.';
            }

            $stmt->close();
        }
    } else {
        $response['error'] = 'Missing required data.';
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>