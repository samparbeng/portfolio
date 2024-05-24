<?php
// index.php
include 'config.php';
include 'includes/error_handling.php';

$portfolioItems = [];

if ($stmt = $conn->prepare('SELECT id, title, image FROM portfolio_items ORDER BY created_at DESC')) {
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
    <title>My Portfolio Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="toggle-button" onclick="toggleSidebar()">☰ Menu</div>
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <h1>My Portfolio Dashboard</h1>
            <div class="portfolio-grid">
                <?php if (!empty($portfolioItems)): ?>
                    <?php foreach ($portfolioItems as $item): ?>
                        <div class="portfolio-item">
                            <a href="portfolio-item.php?id=<?php echo htmlspecialchars($item['id']); ?>">
                                <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>">
                                <h2><?php echo htmlspecialchars($item['title']); ?></h2>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No portfolio items found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
