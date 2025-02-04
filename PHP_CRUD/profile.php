<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit;
}

include 'includes/dbcon.php';
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://unpkg.com/lucide@latest/dist/lucide-icons.min.css" rel="stylesheet">
    <style>
        /* Make sure the footer stays at the bottom */
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }
        .navbar-nav .nav-link:hover {
            color: blue !important;
        }
    </style>
</head>
<body>
    
    <!-- Navigation Bar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">MyWebsite</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>  </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Section -->
    <main class="container mt-4">
        <div class="card text-center mx-auto" style="max-width: 500px;">
            <h2 class="mb-3">Welcome, <?php echo $_SESSION['first_name']; ?>!</h2>
            <img src="<?php echo $row['profile_photo'] ? $row['profile_photo'] : 'images/default_profile.jpg'; ?>" alt="Profile Photo" class="profile-image mb-3">
            <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
            <a href="profile_update.php" class="btn btn-primary">Update Profile</a>
        </div>
    </main>
    

    <!-- Footer Section -->
    <footer class="footer py-3 bg-light text-center mt-auto">
        <div class="container">
            <span class="text-muted">Copyright © 2023 MyWebsite</span>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/lucide.min.js"></script>
    <script>
      // Initialize Lucide Icons
      lucide.icons.forEach(icon => {
        lucide.createIcons(icon)
      })
    </script>
</body>
</html>
