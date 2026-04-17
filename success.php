<?php
include 'config/init.php';
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey("");

// ---------------- VALIDATION ----------------

if (!isset($_GET['session_id'])) {
    die("Invalid access");
}

if (!isset($_SESSION['pending_order'])) {
    die("Session expired. Order not found.");
}

$session_id = $_GET['session_id'];

// ---------------- FETCH STRIPE ----------------

$session = \Stripe\Checkout\Session::retrieve($session_id);

// check payment status
if ($session->payment_status !== 'paid') {
    die("Payment not completed");
}

// ---------------- DATA ----------------

$payment_intent = $session->payment_intent;

$pending = $_SESSION['pending_order'];

$txn_id = $pending['txn_id'];
$user_id = $_SESSION['user']['id'] ?? 0;

$user = $conn->prepare("SELECT * FROM users WHERE id = ?");
$user->bind_param("i", $user_id);
$user->execute();
$user = $user->get_result()->fetch_assoc();


// prevent duplicate order (IMPORTANT)
$check = $conn->prepare("SELECT id FROM orders WHERE txn_id = ?");
$check->bind_param("s", $txn_id);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    die("Order already processed");
}

// ---------------- INSERT ORDER ----------------

$stmt = $conn->prepare("
    INSERT INTO orders 
    (user_id, txn_id, stripe_payment_id, total_amount, status,
     customer_name, customer_email,customer_phone, address, city, pincode)
    VALUES (?, ?, ?, ?, 'paid', ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ississssss",
    $user_id,
    $txn_id,
    $payment_intent,
    $pending['amount'],
    $pending['name'],
    $pending['email'],
    $user['phone'],
    $pending['address'],
    $pending['city'],
    $pending['pincode']
);

$stmt->execute();

$order_id = $stmt->insert_id;

// ---------------- INSERT ITEMS ----------------

foreach ($pending['cart'] as $item) {

    $stmt2 = $conn->prepare("
        INSERT INTO order_items 
        (order_id, product_id, product_name, price, qty)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt2->bind_param(
        "iisii",
        $order_id,
        $item['id'],
        $item['name'],
        $item['price'],
        $item['qty']
    );

    $stmt2->execute();
}


unset($_SESSION['pending_order']);
unset($_SESSION['cart']);
include "components/header.php"
?>


<div class="container my-5">

<div class="card border-0 shadow-lg rounded-4 p-5 text-center">

    <!-- Success Icon -->
    <div class="mb-4">
        <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
             style="width: 80px; height: 80px; font-size: 2rem;">
            ✓
        </div>
    </div>

    <!-- Title -->
    <h2 class="fw-bold text-success mb-2">Payment Successful</h2>
    <p class="text-muted mb-4">Thank you for your purchase. Your order has been confirmed.</p>

    <!-- Order Info -->
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="bg-light rounded-4 p-4 text-start">

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Transaction ID</span>
                    <strong><?php echo $txn_id; ?></strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Stripe Payment</span>
                    <strong class="text-truncate" style="max-width: 180px;">
                        <?php echo $payment_intent; ?>
                    </strong>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Email</span>
                    <strong><?php echo htmlspecialchars($user['email']); ?></strong>
                </div>

                <div class="d-flex justify-content-between border-top pt-3 mt-3">
                    <span class="fw-bold">Total Paid</span>
                    <span class="fw-bold text-primary fs-5">
                        ₹<?php echo number_format($pending['amount']); ?>
                    </span>
                </div>

            </div>

        </div>
    </div>

    <!-- Actions -->
    <div class="mt-5 d-flex justify-content-center gap-3 flex-wrap">

        <a href="products.php" class="btn btn-outline-primary px-4 py-2 rounded-pill">
            Continue Shopping
        </a>

        <a href="orders.php" class="btn btn-primary px-4 py-2 rounded-pill">
            View Orders
        </a>

    </div>

</div>


</div>


<?php
include "components/footer.php";
unset($_SESSION['cart']);
unset($_SESSION['pending_order']);
?>