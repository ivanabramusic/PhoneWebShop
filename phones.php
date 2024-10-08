<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phones Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/script.js" defer></script>
    <style>
        .phone-table img {
            max-width: 100px; /* Adjust the image size as needed */
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="admin.php">Back</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <h1 class="text-center mb-4">Phones List</h1>
        <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addPhoneModal">Add New Phone</a>
        <table class="table table-striped phone-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="phones-list">
                <!-- Phones will be loaded here -->
            </tbody>
        </table>
    </div>



    <?php include 'modals.php'; ?>
    
</body>
</html>
