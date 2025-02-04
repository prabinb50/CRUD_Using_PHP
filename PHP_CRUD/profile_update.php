<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
                            <a class="nav-link" href="index.php">Home</a>  
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Profile Update Form Section -->
    <main class="container mt-5 mb-5 d-flex justify-content-center">
        <div class="card p-4 shadow-sm" style="max-width: 500px; width: 100%;">
            <h2 class="text-center mb-4">Update Profile</h2>
            
            <form action="profile_update_process.php" method="post" enctype="multipart/form-data">
                
                <!-- Profile Photo Upload -->
                <div class="mb-3 text-center">
                    <label for="profile_photo" class="form-label fw-bold">Profile Photo</label>
                    <input type="file" class="form-control" name="profile_photo" id="profile_photo">
                    
                    <!-- Display current profile image -->
                    <img src="<?php echo $row['profile_photo'] ? $row['profile_photo'] : 'images/default_profile.jpg'; ?>" 
                         alt="Profile Photo" 
                         class="img-thumbnail mt-3" 
                         style="max-width: 150px; height: auto;">
                </div>

                <!-- First Name -->
                <div class="mb-3">
                    <label for="first_name" class="form-label fw-bold">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>
                </div>

                <!-- Last Name -->
                <div class="mb-3">
                    <label for="last_name" class="form-label fw-bold">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                </div>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">Copyright © 2023 MyWebsite</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* Navbar Hover Effects */
        .navbar-nav .nav-link:hover {
            color: blue !important; /* Change text color to blue on hover */
        }

        /* Card Styling */
        .card {
            border-radius: 10px;
        }

        /* Update Button Hover Effect */
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        /* Ensure Footer Stays at Bottom */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1; /* Push footer to bottom */
        }
    </style>

</body>
</html>
