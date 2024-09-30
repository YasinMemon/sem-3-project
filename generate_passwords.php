<?php
// Example passwords
$adminPassword = 'admin123'; // Change this to a strong password
$userPassword = 'user123';    // Change this to a strong password

// Hash the passwords
$hashedAdminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
$hashedUserPassword = password_hash($userPassword, PASSWORD_DEFAULT);

// Output the hashed passwords
echo "Hashed Admin Password: " . $hashedAdminPassword . "\n";
echo "Hashed User Password: " . $hashedUserPassword . "\n";
?>
