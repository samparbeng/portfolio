<?php
// admin/login.php
include '../config.php';
include '../includes/error_handling.php';

$result = $conn->query('SELECT COUNT(*) AS count FROM admin_users');
$row = $result->fetch_assoc();

if ($row['count'] == 0) {
    header('Location: ../setup.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($stmt = $conn->prepare('SELECT password FROM admin_users WHERE username = ?')) {
        $stmt->bind_param('s', $username);
        if ($stmt->execute()) {
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();
                if (password_verify($password, $hashed_password)) {
                    createUserSession($username);
                    header('Location: index.php');
                    exit;
                } else {
                    displayError("Invalid username or password.");
                }
            } else {
                displayError("Invalid username or password.");
            }
            $stmt->close();
        } else {
            logError("Failed to execute query: " . $stmt->error);
            displayError("An error occurred. Please try again later.");
        }
    } else {
        logError("Failed to prepare query: " . $conn->error);
        displayError("An error occurred. Please try again later.");
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Admin Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>