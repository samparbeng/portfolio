<?php
// auth/authenticate.php
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($stmt = $conn->prepare('SELECT id, password FROM admin_users WHERE username = ?')) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                createUserSession($username);
                header('Location: ../admin/index.php');
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid username.";
        }

        $stmt->close();
    } else {
        echo "Database query failed.";
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
    <form action="authenticate.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
