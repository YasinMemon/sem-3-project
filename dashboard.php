<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';  // Include database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="sty.css">
</head>
<body></body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    
    <h3>Blogs:</h3>
    <?php
    $sql = "SELECT * FROM blogs";  // Fetch all blogs
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<h4>" . htmlspecialchars($row['title']) . "</h4>";
            echo "<p>" . htmlspecialchars($row['content']) . "</p>";
            
            if ($_SESSION['role'] == 'admin') {
                echo "<a href='blog_edit.php?id=" . $row['id'] . "'>Edit</a> | ";
                echo "<a href='blog_delete.php?id=" . $row['id'] . "'>Delete</a>";
            }
            echo "<hr>";
        }
    } else {
        echo "No blogs available.";
    }
    
    if ($_SESSION['role'] == 'admin') {
        echo "<a href='blog_create.php'>Create New Blog</a>";
    }
    ?>
    
    <a href="logout.php">Logout</a>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
