<?php 
include 'config/init.php'; 
include 'components/product_card.php';
include 'components/header.php'; 

$categories = getCategories($conn,$is_demo);
$all_products = getProducts($conn, $is_demo);

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q !== '') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR short_description LIKE ?");
    $search = "%" . $q . "%";
    $stmt->bind_param("ss", $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products WHERE is_active = 1 AND stock > 1");
}


$categories = $conn->query("SELECT * FROM categories");
?>

<div class="container my-5">

<div class="row mb-5 text-center">
        <h5 class="fw-bold text-uppercase small text-muted mb-4">Browse by Category</h5>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <a href="category.php?slug=<?php echo $cat['slug']; ?>" class="btn btn-white border shadow-sm rounded-pill px-4 py-2 category-chip"><?php echo $cat['name']; ?></a>
<?php endwhile; ?>
        </div>
    </div>


        <div class="">

            <div class="row g-4">
        <?php while ($pro = $result->fetch_assoc()): ?>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <?php createProductCard($pro,$BASE_URL); ?>
        </div>
        <?php endwhile; ?>

        <?php if ($result->num_rows === 0): ?>
    <p>No products found for "<?php echo htmlspecialchars($q); ?>"</p>
<?php endif; ?>
            </div>
</div>

<?php include 'components/footer.php'; ?>