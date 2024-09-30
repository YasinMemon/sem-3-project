<?php
session_start();
require 'db.php'; // Include database connection file

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

// Fetch blogs from the database to display
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <h3>Blogs</h3>
    <div>
        <!-- Logic to display blogs -->
    </div>
    
    <nav>
        <a href="logout.php">Logout</a>
    </nav>
    <footer>
        <p>&copy; 2024 Blog Platform. All rights reserved.</p>
    </footer>
</body>
</html>
