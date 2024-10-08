<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

include('fetch_user_data.php'); // The file where user data is fetched from the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .fixed-top-left {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000; /* Ensure the button is above other content */
        }
        .content {
            margin-top: 70px; /* Adjust based on button height to avoid overlap */
        }
    </style>
</head>
<body>
    <!-- Back to Home Button -->
    <a href="index.php" class="btn btn-outline-dark fixed-top-left">Back to Homepage</a>
    
    <div class="container mt-5 content">
        <h1 class="mb-4">Profile</h1>
        
        <!-- User Details Section -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Details</h5>
                <p><strong>Name:</strong> <span id="user-name"><?php echo htmlspecialchars($name); ?></span></p>
            <p><strong>Surname:</strong> <span id="user-surname"><?php echo htmlspecialchars($surname); ?></span></p>
            <p><strong>Username:</strong> <span id="user-username"><?php echo htmlspecialchars($username); ?></span></p>
            <p><strong>Email:</strong> <span id="user-email"><?php echo htmlspecialchars($email); ?></span></p>
            <p><strong>Balance:</strong> $<span id="user-balance"><?php echo number_format($balance, 2); ?></span></p>
                
                <!-- Buttons for editing and changing password -->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit Profile</button>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'modals.php'; ?>
    <script src="scripts/script.js"></script>

    
</body>
</html>
