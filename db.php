<?php
$servername = "localhost";  // Or your MySQL server name
$username = "root";         // Your MySQL username (default for XAMPP is 'root')
$password = "";             // Your MySQL password (default for XAMPP is an empty string)
$dbname = "blog_platform";  // The actual name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    echo "Could not connect to the database. Please try again later.";
    exit(); // Stop script execution
}

// Close connection when done
// $conn->close(); // Uncomment this line to close the connection when you're done
?>
