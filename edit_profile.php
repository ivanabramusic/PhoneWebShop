<?php
// EDIT USER PROFILE KAO USER
session_start();

// Include MySQLi database connection file
include 'db_connect.php';

$response = array('success' => false, 'error' => '', 'name' => '', 'surname' => '', 'username' => '', 'email' => '');
$error = '';
$success = false;
$redirect_url = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required POST data is set
    if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $userId = $_SESSION['id']; // Make sure session ID is set

        // Prepare and bind MySQLi statement
        $sql = "UPDATE users SET name = ?, surname = ?, username = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssi", $name, $surname, $username, $email, $userId);
            if ($stmt->execute()) {
                // Update session data
                $_SESSION['name'] = $name;
                $_SESSION['surname'] = $surname;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                $response['success'] = true;
                $response['name'] = $name;
                $response['surname'] = $surname;
                $response['username'] = $username;
                $response['email'] = $email;

                $success = true;
                $redirect_url = 'profile.php'; // You can redirect to profile page if needed
            } else {
                $error = "Failed to update profile: " . $stmt->error;
                $response['error'] = $error;
            }
            $stmt->close();
        } else {
            $error = "Database error: " . $conn->error;
            $response['error'] = $error;
        }
    } else {
        $error = "Missing required data.";
        $response['error'] = $error;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
