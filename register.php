<?php
//REGISTRACIJA USERA
session_start();
include('db_connect.php'); // Ensure this file contains your database connection details

$error = ''; 
$success = false;
$redirect_url = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];

        if ($password !== $repeat_password) {
            $error = "Passwords do not match.";
        } 
        else {
            

            // Check if username or email already exists
            $sql = "SELECT * FROM users WHERE username=? OR email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error = "Username or Email already exists.";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (name, surname, username, email, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssss", $name, $surname, $username, $email, $hashedPassword);

                if ($stmt->execute()) {
                    $_SESSION['id'] = $stmt->insert_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['name'] = $name;
                    $_SESSION['surname'] = $surname;
                    $_SESSION['email'] = $email;
                    $_SESSION['balance'] = 0;
                    $_SESSION['loggedin'] = true;
                    $_SESSION['admin_loggedin'] = false; // Not an admin

                    $success = true;
                    $redirect_url = 'index.php';
                } else {
                    $error = "Error: " . $stmt->error;
                }
            }
            $stmt->close();
        }
        $conn->close();
    } else {
        $error = "Please fill in all required fields.";
    }
    echo json_encode(array('success' => $success, 'error' => $error, 'redirect' => $redirect_url ?? ''));
}
?>
