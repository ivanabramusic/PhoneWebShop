<?php
// LOGIN USERA
session_start();
include('db_connect.php');

$error = '';
$success = false;
$redirect_url = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        // Admin login check
        if ($username === 'admin' && $password === 'admin') {
            $_SESSION['loggedin'] = true;
            $_SESSION['admin_loggedin'] = true;
            $_SESSION['username'] = $username;
            $success = true;
            $redirect_url = 'admin.php'; // Redirect to admin page
        } else {
            // Check if the user exists in the database
            $sql = "SELECT * FROM users WHERE username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Verify the password using password_verify()
                if (password_verify($password, $row['password'])) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['surname'] = $row['surname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['balance'] = $row['balance'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['admin_loggedin'] = false; // Not an admin

                    $success = true;
                    $redirect_url = 'index.php'; // Redirect to regular user page
                } else {
                    $error = "Incorrect password. Please try again.";
                }
            } else {
                $error = "User with this username does not exist.";
            }

            $stmt->close();
        }

        $conn->close();
    } else {
        $error = "Please enter both username and password.";
    }

    // Return JSON response
    echo json_encode(array('success' => $success, 'error' => $error, 'redirect' => $redirect_url));
}
