<?php
// portfolio-item.php
include 'config.php';
include 'includes/error_handling.php';

if (!isset($_GET['id'])) {
    logError("No portfolio item ID provided.");
    displayError("No portfolio item ID provided.");
    exit;
}

$id = $_GET['id'];

$portfolioItem = null;

if ($stmt = $conn->prepare('SELECT id, title, description, image, created_at FROM portfolio_items WHERE id = ?')) {
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $portfolioItem = $result->fetch_assoc();
        } else {
            logError("Portfolio item not found: ID $id");
            displayError("Portfolio item not found.");
        }
        $stmt->close();
    } else {
        logError("Failed to execute query: " . $stmt->error);
        displayError("An error occurred while fetching the portfolio item. Please try again later.");
    }
} else {
    logError("Failed to prepare query: " . $conn->error);
    displayError("An error occurred while fetching the portfolio item. Please try again later.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $portfolioItem ? htmlspecialchars($portfolioItem['title']) : "Portfolio Item"; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="index.php">Back to Portfolio</a>
    <?php if ($portfolioItem): ?>
        <div class="portfolio-item-detail">
            <h1><?php echo htmlspecialchars($portfolioItem['title']); ?></h1>
            <img src="uploads/<?php echo htmlspecialchars($portfolioItem['image']); ?>" alt="<?php echo htmlspecialchars($portfolioItem['title']); ?>">
            <p><?php echo nl2br(htmlspecialchars($portfolioItem['description'])); ?></p>
            <p class="created-at">Created on: <?php echo htmlspecialchars($portfolioItem['created_at']); ?></p>
        </div>
    <?php else: ?>
        <p>Portfolio item not found.</p>
    <?php endif; ?>
</body>
</html>
