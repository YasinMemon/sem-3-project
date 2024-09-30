<?php
// Start the session and include the database connection
session_start();
require 'db.php'; // Database connection

// Check if the blog ID is provided in the URL
if (isset($_GET['id'])) {
    $blog_id = intval($_GET['id']);

    // Fetch the blog with the given ID
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();

    // Check if the blog exists
    if (!$blog) {
        echo "Blog not found.";
        exit();
    }
} else {
    echo "No blog ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($blog['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <!-- Header Section -->
    <header class="bg-white shadow-lg">
        <nav class="container mx-auto px-6 py-4">
            <ul class="flex items-center space-x-6">
                <li><a href="index.php" class="text-gray-700 hover:text-blue-500 font-semibold">Home</a></li>
                <li><a href="about.html" class="text-gray-700 hover:text-blue-500 font-semibold">About</a></li>
                <li><a href="contact.html" class="text-gray-700 hover:text-blue-500 font-semibold">Contact</a></li>
                <li><a href="blogs.php" class="text-gray-700 hover:text-blue-500 font-semibold">Blogs</a></li>
                <li class="ml-auto">
                    <?php if (isset($_SESSION['username'])): ?>
                        <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded">Sign In</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Blog Details Section -->
    <main class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-semibold text-gray-800 mb-4"><?php echo htmlspecialchars($blog['title']); ?></h1>
            <p class="text-gray-700 leading-relaxed mb-6"><?php echo htmlspecialchars($blog['content']); ?></p>
            <p class="text-sm text-gray-500">Published on: <?php echo htmlspecialchars($blog['created_at']); ?></p>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white py-6">
        <p class="text-center">&copy; 2023 Blog Platform. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
