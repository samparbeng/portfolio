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
$backImage = $_FILES['back_image']['name'];

$targetImage = "../uploads/" . basename($image);
$targetBackImage = "../uploads/" . basename($backImage);

$imageUploaded = move_uploaded_file($_FILES['image']['tmp_name'], $targetImage);
$backImageUploaded = move_uploaded_file($_FILES['back_image']['tmp_name'], $targetBackImage);

if ($imageUploaded && $backImageUploaded) {
    if ($stmt = $conn->prepare('INSERT INTO portfolio_items (title, description, image, back_image) VALUES (?, ?, ?, ?)')) {
        $stmt->bind_param('ssss', $title, $description, $image, $backImage);
        
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
    $error_message = "Failed to upload images.";
    logError($error_message);
    displayError("Failed to upload images. Please try again.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Add Portfolio Item</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Styling for the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <a href="index.php">Back to Admin</a>

    <h2>Portfolio Items</h2>

    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Back Image</th>
        </tr>

        <?php
        // Include database connection and error handling functions if not already included
        // include '../config.php';
        // include '../includes/error_handling.php';

        // Assuming $conn is your database connection object

        // Fetch portfolio items from database
        $sql = "SELECT title, description, image, back_image FROM portfolio_items";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                echo "<td><img src='../uploads/" . htmlspecialchars($row["image"]) . "' class='thumbnail'></td>";
                echo "<td><img src='../uploads/" . htmlspecialchars($row["back_image"]) . "' class='thumbnail'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No portfolio items found.</td></tr>";
        }
        $conn->close();
        ?>
    </table>

</body>
</html>


