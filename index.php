<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Shop</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="scripts/script.js"></script>
</head>
<body>
<div id="cart-message" class="alert-container"></div>
    <!-- Include header -->
    <?php include 'header.php'; ?>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <div class="row mb-3">
            <div class="col-md-3 mb-2 mb-md-0">
                <select name="sort" id="sort-select" class="form-control-lg">
                    <option value="default" selected disabled hidden>Sort By</option>
                    <option value="name-asc">Name: A-Z</option>
                    <option value="name-desc">Name: Z-A</option>
                    <option value="price-asc">Price: ascending</option>
                    <option value="price-desc">Price: descending</option>
                </select>
            </div>
        </div>
        <div id="products-container"class="row">
            <?php
            // Fetch and display images or content
            include 'fetch_images.php';
            ?>
        </div>
    </div>

    <!-- Include Modals -->
    <?php include 'modals.php'; ?>

    <!-- Bootstrap JS and Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    var isLoggedIn = <?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? 'true' : 'false'; ?>;
    </script>
</body>
</html>
