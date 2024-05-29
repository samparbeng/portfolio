<?php
// admin/index.php
include '../config.php';

if (!isAuthenticated()) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add Portfolio Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div>
    <h2>Add New Portfolio Item</h2>
    <form action="add.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
    
        <label for="image">Main Image:</label>
        <input type="file" name="image" id="image" required>
    
        <label for="back_image">Background Image:</label>
        <input type="file" name="back_image" id="back_image" required>
    
        <button type="submit">Submit</button>
    </form>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
