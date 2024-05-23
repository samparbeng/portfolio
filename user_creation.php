<?php
// user_creation.php
include 'config.php';

$username = 'admin'; // Change as needed
$password = 'password'; // Change as needed

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

if ($stmt = $conn->prepare('INSERT INTO admin_users (username, password) VALUES (?, ?)')) {
    $stmt->bind_param('ss', $username, $hashed_password);
    if ($stmt->execute()) {
        echo "Admin user created successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Database query failed.";
}

$conn->close();
?>
