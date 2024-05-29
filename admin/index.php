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
        <input type="text" id="title" name="title" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" required>
        
        <button type="submit">Add Item</button>
    </form>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>
