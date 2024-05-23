<?php
// index.php
include 'config.php';
include 'includes/error_handling.php';

$portfolioItems = [];

if ($stmt = $conn->prepare('SELECT id, title, description, image, created_at FROM portfolio_items ORDER BY created_at DESC')) {
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $portfolioItems[] = $row;
        }
        $stmt->close();
    } else {
        logError("Failed to execute query: " . $stmt->error);
        displayError("An error occurred while fetching portfolio items. Please try again later.");
    }
} else {
    logError("Failed to prepare query: " . $conn->error);
    displayError("An error occurred while fetching portfolio items. Please try again later.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>My Portfolio</h1>
    <div class="portfolio-items">
        <?php if (!empty($portfolioItems)): ?>
            <?php foreach ($portfolioItems as $item): ?>
                <div class="portfolio-item">
                    <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                    <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                    <p><?php echo nl2br(htmlspecialchars($item['description'])); ?></p>
                    <p class="created-at"><?php echo htmlspecialchars($item['created_at']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No portfolio items found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
