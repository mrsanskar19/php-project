<?php
function createProductCard($product, $BASE_URL) {

    if (!$product['is_active']) return;

    $id = $product['id'];
    $name = htmlspecialchars($product['name']);
    $slug = $product['product_slug'];
    $price = (int)$product['price'];
    $tag = $product['tag'];
    $desc = htmlspecialchars($product['short_description']);
    $stock = (int)$product['stock'];
    $image = $product['image'] ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwCR4DIFW8BUwQ8wEIAU1wwVwmFvGHznmG8Q&s';

    $productUrl = $BASE_URL . "product.php?slug=" . urlencode($slug);

    echo '
    <div class="card product-card h-100 border-0 p-3 shadow-sm">

        <div class="position-relative product-image-wrapper">
            <img src="'.$image.'" class="product-image rounded-4" alt="'.$name.'">

            '.($tag ? '<span class="badge bg-dark position-absolute top-0 start-0 m-2">'.$tag.'</span>' : '').'

            '.($stock <= 0 ? '<span class="badge bg-danger position-absolute top-0 end-0 m-2">Out of Stock</span>' : '').'
        </div>

        <div class="card-body p-0 mt-2">

            <h6 class="fw-bold mb-1">
                <a href="'.$productUrl.'" class="text-decoration-none text-dark">'.$name.'</a>
            </h6>

            <p class="text-muted small mb-2">'.$desc.'</p>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-bold text-primary fs-5">₹'.number_format($price).'</span>
                <small class="text-muted">'.($stock > 0 ? $stock.' left' : 'Unavailable').'</small>
            </div>

         <div class="d-grid gap-2">

'.($stock > 0 ? '

<button 
    onclick="addToCart('.$id.', \''.addslashes($name).'\', '.$price.')" 
    class="btn btn-outline-primary btn-sm rounded-3">
    Add to Cart
</button>

<form action="'.$BASE_URL.'create-checkout.php" method="POST">
    <input type="hidden" name="product_id" value="'.$id.'">
    <button type="submit" class="btn btn-primary-custom btn-sm rounded-3 w-100">
        Buy Now
    </button>
</form>

' : '

<button class="btn btn-secondary btn-sm rounded-3" disabled>
    Out of Stock
</button>

').'

</div>

        </div>
    </div>';
}
?>