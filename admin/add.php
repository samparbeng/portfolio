<?php
// admin/add.php
include '../config.php';
include '../includes/error_handling.php';

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
            $error_message = "Database error: " . $stmt->error;
            logError($error_message);
            displayError("An error occurred while adding the portfolio item. Please try again later.");
        }

        $stmt->close();
    } else {
        $error_message = "Database query preparation failed.";
        logError($error_message);
        displayError("An error occurred. Please try again later.");
    }
} else {
    $error_message = "Failed to upload image.";
    logError($error_message);
    displayError("Failed to upload image. Please try again.");
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
