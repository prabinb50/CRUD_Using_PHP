<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character set and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Page title -->
    <title>MyWebsite</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide icons CSS for using icons -->
    <link href="https://unpkg.com/lucide@latest/dist/lucide-icons.min.css" rel="stylesheet">
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <!-- Navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Website brand/logo -->
                <a class="navbar-brand" href="#">MyWebsite</a>
                <!-- Toggler for smaller screens -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Check if the user is logged in, if so show profile and logout links -->
                        <?php if(isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a href="profile.php" class="nav-link"><i data-lucide="user" class="me-2"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <a href="logout.php" class="nav-link"><i data-lucide="log-out" class="me-2"></i> Logout</a>
                            </li>
                        <!-- If the user is not logged in, show login and register options -->
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i data-lucide="log-in" class="me-2"></i> Login
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="login.php">Login</a></li>
                                    <li><a class="dropdown-item" href="register.php">Sign Up</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        <div class="hero">
            <div class="hero-content">
                <!-- Main heading and description for the page -->
                <h1>Welcome to MyWebsite</h1>
                <p>A simple website for managing your profile.</p>
                <div class="button-group">
                    <!-- Call-to-action buttons -->
                    <a href="register.php" class="btn btn-primary me-2">Get Started</a>
                    <a href="login.php" class="btn btn-secondary">Login</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <!-- Footer with copyright info -->
            <span class="text-muted">Copyright © 2023 MyWebsite</span>
        </div>
    </footer>

    <!-- Bootstrap JS for responsive and interactive features -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Lucide icons JS for creating icons -->
    <script src="https://unpkg.com/lucide@latest/dist/lucide.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.icons.forEach(icon => {
            lucide.createIcons(icon)
        })
    </script>
</body>
</html>
