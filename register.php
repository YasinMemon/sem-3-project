<?php
include 'db.php';  // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $role = $_POST['role']; // 'admin' or 'user'

    // Check if username already exists
    $checkSql = "SELECT * FROM users WHERE username='$username'";
    $checkResult = $conn->query($checkSql);
    if ($checkResult->num_rows > 0) {
        echo "<p class='text-red-500'>Username already exists. Please choose another one.</p>";
    } else {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<p class='text-green-500'>New user created successfully</p>";
            // Redirect to login page after 2 seconds
            header("Location: login.php");
            exit(); // Ensure script terminates after redirection
        } else {
            echo "<p class='text-red-500'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">User Registration</h2>

        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Role:</label>
                <select id="role" name="role" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            
            <button type="submit" class="w-full py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-md transition duration-200">
                Register
            </button>
        </form>
    </div>

</body>
</html>
