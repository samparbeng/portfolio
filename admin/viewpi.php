<?php

// admin/add.php

include '../config.php';
include '../includes/error_handling.php';

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


