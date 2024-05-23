<?php
// admin/add.php
include '../config.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$title = $_POST['title'];
$description = $_POST['description'];
$image = $_FILES['image']['name'];
$target = "../uploads/" . basename($image);

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    if ($stmt = $conn->prepare('INSERT INTO portfolio_items (title, description, image) VALUES (?, ?, ?)')) {
        $stmt->bind_param('sss', $title, $description, $image);
        
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Database query failed.";
    }
} else {
    echo "Failed to upload image.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add Portfolio Item</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <a href="index.php">Back to Admin</a>
</body>
</html>
