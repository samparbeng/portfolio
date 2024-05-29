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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#3e454c">
<title>Project Dashboard</title>
<!-- Font awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Sandstone Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Bootstrap Datatables -->
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
<!-- Bootstrap social button library -->
<link rel="stylesheet" href="css/bootstrap-social.css">
<!-- Bootstrap select -->
<link rel="stylesheet" href="css/bootstrap-select.css">
<!-- Bootstrap file input -->
<link rel="stylesheet" href="css/fileinput.min.css">
<!-- Awesome Bootstrap checkbox -->
<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<!-- Admin Stye -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/majorco.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
</head>
<body>
    <?php include('includes/header.php');?>
    <div class="main-content">
        <?php include('includes/sidebar.php'); ?>
        <div class="toggle-button" onclick="toggleSidebar()">☰ Menu</div>
                <h1>Project Dashboard</h1> 
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
