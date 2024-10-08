<?php
// UCITAVANJE USERDATA ZA EDIT PROFILA

$servername = "localhost";
$dbname = "phone_shop";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch user data
    $stmt = $pdo->prepare("SELECT name, surname, username, email, password, balance FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $name = $user['name'];
        $surname = $user['surname'];
        $username = $user['username'];
        $email = $user['email'];
        $password = $user['password'];
        $balance = $user['balance'];
    } else {
        echo "User not found";
        exit;
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}
?>
