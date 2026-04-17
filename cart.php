<?php 
include 'config/init.php';
include 'components/header.php';
?>

<div class="container my-5">
    <h2 class="fw-bold mb-4 text-primary-custom">Shopping Cart</h2>

    <div class="row g-4">

        <div class="col-lg-8">
            <div class="card p-4 shadow-sm" id="cart-items">
                <!-- JS will render items -->
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card p-4 shadow-sm">
                <h5 class="fw-bold mb-3">Summary</h5>

                <div class="d-flex justify-content-between mb-2">
                    <span>Total</span>
                    <span id="cart-total">₹0</span>
                </div>

                <button onclick="clearCart()" class="btn btn-outline-danger w-100 mb-2">
                    Clear Cart
                </button>

                <a href="checkout.php" class="btn btn-primary w-100">
                    Proceed to Checkout
                </a>
            </div>
        </div>

    </div>
</div>

<?php include 'components/footer.php'; ?>