<?php 
include 'config/init.php'; 
include 'components/header.php'; 
?>

<div class="container my-5">
    <div class="row g-5">

    <!-- LEFT -->
    <div class="col-lg-8">
        <h4 class="fw-bold mb-4">Shipping Information</h4>

        <form action="checkout/create-checkout.php" method="POST">

            <!-- Hidden cart data -->
            <input type="hidden" name="cart_data" id="cart-data">
            <input type="hidden" name="total_amount" id="total-amount">

            <div class="row g-3">
                <div class="col-sm-6">
                    <input name="first_name" type="text" class="form-control" placeholder="First Name" required>
                </div>
                <div class="col-sm-6">
                    <input name="last_name" type="text" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="col-12">
                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-12">
                    <input name="address" type="text" class="form-control" placeholder="Address" required>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-sm-6">
                    <input type="text" name="pincode" class="form-control" required>
                </div>
            </div>

            <button class="btn btn-primary w-100 py-3 mt-5">
                Pay with Stripe
            </button>
        </form>
    </div>

    <!-- RIGHT -->
    <div class="col-lg-4">
        <div class="card p-4 shadow-sm">
            <h5 class="fw-bold mb-3">Your Cart</h5>

            <div id="checkout-cart"></div>

            <hr>

            <div class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong id="checkout-total">₹0</strong>
            </div>
        </div>
    </div>

</div>

</div>

<script>
function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

function renderCheckout() {
    let cart = getCart();
    let container = document.getElementById("checkout-cart");
    let total = 0;

    container.innerHTML = "";

    cart.forEach(item => {
        let sub = item.price * item.qty;
        total += sub;

        container.innerHTML += `
            <div class="d-flex justify-content-between mb-2">
                <span>${item.name} x ${item.qty}</span>
                <span>₹${sub}</span>
            </div>
        `;
    });

    document.getElementById("checkout-total").innerText = "₹" + total;

    // send to PHP
    document.getElementById("cart-data").value = JSON.stringify(cart);
    document.getElementById("total-amount").value = total;
}

renderCheckout();
</script>

<?php include 'components/footer.php'; ?>
