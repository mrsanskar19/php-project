<?php
include 'config/init.php';
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey(getenv("STRIPE_SECRET"));

if (!isset($_GET['session_id'])) {
    die("Invalid access");
}

if (!isset($_SESSION['pending_order'])) {
    die("Session expired");
}

$session_id = $_GET['session_id'];
$session = \Stripe\Checkout\Session::retrieve($session_id);

if ($session->payment_status !== 'paid') {
    die("Payment not completed");
}

$pending = $_SESSION['pending_order'];

$txn_id = $pending['txn_id'];
$payment_intent = $session->payment_intent;
$email = $pending['email'];
$amount = $pending['amount'];

unset($_SESSION['pending_order']);
unset($_SESSION['cart']);

include 'components/header.php';
?>

<div class="container my-5 d-flex justify-content-center">
    <div class="card border-0 shadow-sm rounded-4 p-5 text-center" style="max-width:600px; width:100%;">

        <div class="mb-4">
            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                 style="width:80px;height:80px;font-size:2rem;">
                ✓
            </div>
        </div>

        <h2 class="fw-bold text-success mb-2">Payment Successful</h2>
        <p class="text-muted mb-4">Thank you for your purchase. Your order has been confirmed.</p>

        <div class="bg-light rounded-4 p-4 text-start mb-4">

            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Transaction ID</span>
                <strong><?php echo $txn_id; ?></strong>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Stripe Payment</span>
                <strong><?php echo substr($payment_intent, 0, 18) . '...'; ?></strong>
            </div>

            <div class="d-flex justify-content-between mb-3">
                <span class="text-muted">Email</span>
                <strong><?php echo htmlspecialchars($email); ?></strong>
            </div>

            <hr>

            <div class="d-flex justify-content-between">
                <span class="fw-bold">Total Paid</span>
                <strong class="text-primary fs-5">₹<?php echo number_format($amount); ?></strong>
            </div>

        </div>

        <div class="d-flex gap-3 justify-content-center">
            <a href="products.php" class="btn btn-outline-primary rounded-pill px-4">
                Continue Shopping
            </a>
            <a href="orders.php" class="btn btn-primary-custom rounded-pill px-4">
                View Orders
            </a>
        </div>

    </div>
</div>

<?php include 'components/footer.php'; ?>