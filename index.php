<?php 
include 'config/init.php';
include 'components/product_card.php';
include 'components/header.php'; 

$categories = $conn->query("SELECT * FROM categories");
$products = $conn->query("SELECT * FROM products WHERE is_active = 1 AND stock > 1 LIMIT 4");

if (!$categories) {
    die("Category Query Failed: " . $conn->error);
}

if (!$products) {
    die("Product Query Failed: " . $conn->error);
}
?>

<div id="heroCarousel" class="carousel slide shadow-sm mb-5" data-bs-ride="carousel">
    <div class="carousel-inner rounded-4 container mt-3">

```
    <div class="carousel-item active">
        <div class="p-5 text-white rounded-4 d-flex align-items-center justify-content-center" style="background: linear-gradient(45deg, #0d6efd, #00002a); min-height: 350px;">
            <div class="text-center">
                <h1 class="display-5 fw-bold">Next-Gen Tech</h1>
                <p class="lead">Exclusive deals on professional computing gear.</p>
                <a href="products.php" class="btn btn-light btn-lg rounded-pill px-5 text-primary fw-bold">Shop Now</a>
            </div>
        </div>
    </div>

    <div class="carousel-item">
        <div class="p-5 text-white rounded-4 d-flex align-items-center justify-content-center" style="background: linear-gradient(45deg, #6c757d, #212529); min-height: 350px;">
            <div class="text-center">
                <h1 class="display-5 fw-bold">Studio Grade Audio</h1>
                <p class="lead">Experience sound like a professional.</p>
                <a href="products.php?slug=audio" class="btn btn-primary-custom btn-lg rounded-pill px-5">Explore Audio</a>
            </div>
        </div>
    </div>

</div>

<button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
</button>
```

</div>

<div class="container">

```
<!-- Categories -->
<div class="row mb-5 text-center">
    <h5 class="fw-bold text-uppercase small text-muted mb-4">Browse by Category</h5>

    <div class="d-flex justify-content-center gap-3 flex-wrap">

        <?php if ($categories->num_rows > 0): ?>
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <a href="products.php?slug=<?php echo urlencode($cat['slug']); ?>" 
                   class="btn btn-white border shadow-sm rounded-pill px-4 py-2 category-chip">
                    <?php echo htmlspecialchars($cat['name']); ?>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No categories found</p>
        <?php endif; ?>

    </div>
</div>

<!-- Featured -->
<div class="row mb-4">
    <div class="col-12 d-flex justify-content-between align-items-end flex-wrap gap-2">
        <div>
            <h2 class="fw-bold text-primary-custom mb-0">Featured Products</h2>
            <p class="text-muted mb-0">Handpicked gear for high-performance needs.</p>
        </div>
        <a href="products.php" class="text-decoration-none fw-bold">View All →</a>
    </div>
</div>

<!-- Products -->
<div class="row g-4">

    <?php if ($products->num_rows > 0): ?>
        <?php while ($pro = $products->fetch_assoc()): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <?php createProductCard($pro, $BASE_URL); ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products available</p>
    <?php endif; ?>

</div>
```

</div>

<?php include 'components/footer.php'; ?>
