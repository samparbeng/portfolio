<?php
// setup.php
include 'config.php';
include 'includes/error_handling.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        displayError("Username and password cannot be empty.");
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        if ($stmt = $conn->prepare('INSERT INTO admin_users (username, password) VALUES (?, ?)')) {
            $stmt->bind_param('ss', $username, $hashed_password);
            if ($stmt->execute()) {
                echo "Admin user created successfully.";
                header('Location: admin/login.php');
                exit;
            } else {
                logError("Failed to create admin user: " . $stmt->error);
                displayError("An error occurred while creating the admin user. Please try again later.");
            }
            $stmt->close();
        } else {
            logError("Failed to prepare query: " . $conn->error);
            displayError("An error occurred while creating the admin user. Please try again later.");
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Setup Admin User</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Setup Admin User</h1>
    <form action="setup.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Create Admin User</button>
    </form>
</body>
</html>
