<?php foreach ($portfolioItems as $item): ?>
<li>
    <a href="#" class="portfolio-card" data-id="<?php echo htmlspecialchars($item['id']); ?>" style="background-image: url('uploads/<?php echo htmlspecialchars($item['back_image']); ?>');">
        <div class="card-content">
            <div class="main-image-container">
                <img src="uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="main-image">
            </div>
            <h3 class="h3 card-title"><?php echo htmlspecialchars($item['title']); ?></h3>
            <span class="btn-link">
                <span>View Project</span>
                <ion-icon name="arrow-forward"></ion-icon>
            </span>
        </div>
    </a>
</li>
<?php endforeach; ?>
