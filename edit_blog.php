<?php
session_start();
require 'db.php';

// Ensure the user is an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Get the blog ID
$blog_id = $_GET['id'];

// Fetch the blog data
$stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

// Handle blog update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $stmt = $conn->prepare("UPDATE blogs SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $content, $blog_id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Edit Blog</h2>

        <form method="POST" action="edit_blog.php?id=<?php echo $blog_id; ?>" class="bg-white p-4 rounded shadow-md">
            <label for="title" class="block mb-2">Blog Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required class="border border-gray-300 p-2 w-full mb-4 rounded">
            <label for="content" class="block mb-2">Blog Content:</label>
            <textarea name="content" required class="border border-gray-300 p-2 w-full mb-4 rounded"><?php echo htmlspecialchars($blog['content']); ?></textarea>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Blog</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
