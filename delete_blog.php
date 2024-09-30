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

// Delete the blog entry
$stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
$stmt->bind_param("i", $blog_id);

if ($stmt->execute()) {
    header('Location: admin_dashboard.php');
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
