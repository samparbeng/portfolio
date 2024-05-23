<?php
// admin/reset_password.php
include '../config.php';
include '../includes/error_handling.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $username = $_SESSION['username'];

    if ($stmt = $conn->prepare('UPDATE admin_users SET password = ? WHERE username = ?')) {
        $stmt->bind_param('ss', $hashed_password, $username);
        if ($stmt->execute()) {
            echo "Password updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
            logError($stmt->error);
        }
        $stmt->close();
    } else {
        echo "Database query failed.";
        logError("Database query preparation failed.");
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Reset Password</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Reset Password</h1>
    <form action="reset_password.php" method="post">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit">Reset Password</button>
    </form>
    <a href="index.php">Back to Admin</a>
</body>
</html>
