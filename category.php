<?php 
include 'config/init.php'; 
include 'components/product_card.php';
include 'components/header.php'; 

$categories = getCategories($conn,$is_demo);
$all_products = getProducts($conn, $is_demo);

$q = isset($_GET['slug']) ? $_GET['slug'] : '';

if ($q !== '') {
    $stmt = $conn->prepare("SELECT * FROM products WHERE category_slug = ?");
    $stmt->bind_param("s", $q);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products WHERE is_active = 1");
}
?>

<div class="container my-5">
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