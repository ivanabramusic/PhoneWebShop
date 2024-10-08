<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top py-3">
        <div class="container-fluid">
            <!-- Logo and Cart Button -->
            <?php 
            
            // Check if the user is logged in
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <a class="navbar-brand d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#cartModal">
        <button type="button" class="btn btn-secondary d-flex align-items-center">
            <i class="bi bi-cart"></i> Cart
            <span id="cart-badge" class="badge bg-primary ms-2"></span>
        </button>
    </a>
            <?php endif; ?>

            <!-- Center Title -->
            <a class="navbar-brand mx-auto" href="#">Phone Shop</a>

            <!-- Toggle Button for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Items -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        
                        <?php if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true): ?>
                            <!-- Admin Redirect -->
                            <script>
                                window.location.href = 'admin.php';
                            </script>
                        <?php endif; ?>

                        <li class="nav-item d-flex align-items-center me-3">
    <span id="user-balance" class="me-2">Balance: $<?php echo number_format($_SESSION['balance'], 2); ?></span>
</li>
<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $_SESSION['username']; ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#balanceModal">Add Balance</a></li>
        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
    </ul>
</li>



                    <?php else: ?>
                        <!-- Login Button (if not logged in) -->
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>
