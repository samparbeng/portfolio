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
<header class="header" data-header>
        <div class="container">
            <a href="#">
                <h1 class="logo">Samuel A.</h1>
            </a>
            <button class="nav-toggle-btn" aria-label="Toggle Menu" data-nav-toggle-btn>
                <ion-icon name="menu-outline" class="menu-icon"></ion-icon>
                <ion-icon name="close-outline" class="close-icon"></ion-icon>
            </button>
            <nav class="navbar container">
                <ul class="navbar-list">
                    <li><a href="#home" class="navbar-link" data-nav-link>Home</a></li>
                    <li><a href="#about" class="navbar-link" data-nav-link>About</a></li>
                    <li><a href="#portfolio" class="navbar-link" data-nav-link>Portfolio</a></li>
                    <li><a href="#skills" class="navbar-link" data-nav-link>Skills</a></li>
                    <li><a href="#contact" class="navbar-link" data-nav-link>Contact</a></li>
                    <li><a href="#blog" class="navbar-link" data-nav-link>Blog</a></li>
                    <li><a href="#" class="btn btn-primary">Download Resume</a></li>
                </ul>
            </nav>
        </div>
    </header>
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
