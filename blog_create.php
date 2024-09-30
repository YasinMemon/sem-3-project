<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];  // Assuming you've set the user ID in the session

    $sql = "INSERT INTO blogs (title, content, user_id) VALUES ('$title', '$content', '$user_id')";

    if ($conn->query($sql) === TRUE) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body>
    <h2>Create Blog</h2>
    <form method="post" action="blog_create.php">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" required></textarea><br>
        <button type="submit">Create Blog</button>
    </form>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
