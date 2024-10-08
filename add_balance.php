<?php
// DODAVANJE BALANCE U DATABASE
session_start();
include('db_connect.php');

$response = array('success' => false, 'error' => '', 'new_balance' => 0);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['amount'])) {
    $amount = $_POST['amount'];
    $userId = $_SESSION['id'];

    if (!is_numeric($amount) || $amount <= 0) {
        $response['error'] = "Invalid amount.";
    } else {
        // Update the user's balance in the database
        $sql = "UPDATE users SET balance = balance + ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $amount, $userId);

        if ($stmt->execute()) {
            // Get the new balance
            $sql = "SELECT balance FROM users WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt->bind_result($new_balance);
            $stmt->fetch();

            $formatted_balance = number_format($new_balance, 2);

            $_SESSION['balance'] = $new_balance;

            $response['success'] = true;
            $response['new_balance'] = $formatted_balance;
        } else {
            $response['error'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
}

echo json_encode($response);
?>
