<?php
session_start();

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$host = 'localhost';
$dbname = 'blog_platform';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blogs
$stmt = $conn->prepare("SELECT * FROM blogs");
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Blog Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    <header class="bg-white shadow-lg">
        <nav class="container mx-auto px-6 py-4">
            <ul class="flex items-center space-x-6">
                <li><a href="index.php" class="text-gray-700 hover:text-blue-500 font-semibold">Home</a></li>
                <li><a href="about.html" class="text-gray-700 hover:text-blue-500 font-semibold">About</a></li>
                <li><a href="contact.html" class="text-gray-700 hover:text-blue-500 font-semibold">Contact</a></li>
                <li><a href="blogs.php" class="text-gray-700 hover:text-blue-500 font-semibold">Blogs</a></li>
                <li class="ml-auto">
                    <a href="login.php" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded shadow">
                        Create
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12">
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='bg-white rounded-lg shadow-lg p-6 transition-transform transform hover:scale-105'>";
                    echo "<h2 class='text-2xl font-semibold mb-2 text-gray-800'>" . htmlspecialchars($row['title']) . "</h2>";
                    echo "<p class='text-gray-600'>" . htmlspecialchars(substr($row['content'], 0, 150)) . "...</p>"; // Shorten content
                    echo "<a href='view_blog.php?id=" . $row['id'] . "' class='mt-4 inline-block text-blue-500 hover:text-blue-700 font-semibold'>Read More</a>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-gray-600'>No blogs found.</p>";
            }
            ?>
        </section>
    </main>

    <footer class="bg-gray-900 text-white py-6">
        <p class="text-center">&copy; 2024 Blog Platform. All Rights Reserved.</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>
