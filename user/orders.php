<?php
include '../config/init.php';
requireLogin();

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT name, email, phone, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// fetch orders
$stmt = $conn->prepare("
    SELECT id, txn_id, total_amount, status, created_at 
    FROM orders 
    WHERE user_id = ? 
    ORDER BY id DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result();

include '../components/header.php';
?>

<div class="container my-5">

```
<div class="row g-4">

    <!-- SIDEBAR -->
    <div class="col-lg-3">

<div class="card border-0 shadow-sm rounded-4 p-4 text-center">

    <!-- Avatar -->
    <div class="mb-3">
        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
             style="width:90px;height:90px;font-size:2.5rem;">
            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
        </div>
    </div>

    <h5 class="fw-bold"><?php echo htmlspecialchars($user['name']); ?></h5>
    <p class="text-muted small"><?php echo htmlspecialchars($user['email']); ?></p> 

    <hr>

    <!-- Menu -->
    <div class="d-grid gap-2">
        <a href="index.php" class="btn btn-light text-start">👤 Profile</a>
        <a href="user/orders.php" class="btn btn-light text-start">📦 Orders</a>
        <a href="../cart.php" class="btn btn-light text-start">🛒 Cart</a>
        <a href="logout.php" class="btn btn-danger text-start">🚪 Logout</a>
    </div>

</div>

</div>
    <!-- ORDERS -->
    <div class="col-lg-9">

        <h4 class="fw-bold mb-4">My Orders</h4>

        <?php if ($orders->num_rows === 0): ?>

            <div class="card p-5 text-center shadow-sm rounded-4">
                <h5>No orders yet</h5>
                <p class="text-muted">Start shopping to see your orders here.</p>
                <a href="../products.php" class="btn btn-primary mt-3">Shop Now</a>
            </div>

        <?php else: ?>

            <?php while ($order = $orders->fetch_assoc()): ?>

            <div class="card shadow-sm rounded-4 mb-4 p-4">

                <!-- TOP -->
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <div>
                        <strong>Order #<?php echo $order['id']; ?></strong><br>
                        <small class="text-muted">
                            <?php echo date("d M Y", strtotime($order['created_at'])); ?>
                        </small>
                    </div>

                    <div class="text-end">
                        <span class="badge 
                            <?php 
                            echo $order['status'] === 'paid' ? 'bg-success' : 'bg-warning'; 
                            ?>">
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </div>

                </div>

                <!-- ITEMS -->
                <div class="border-top pt-3">

                    <?php
                    $stmt2 = $conn->prepare("
                        SELECT product_name, price, qty 
                        FROM order_items 
                        WHERE order_id = ?
                    ");
                    $stmt2->bind_param("i", $order['id']);
                    $stmt2->execute();
                    $items = $stmt2->get_result();

                    while ($item = $items->fetch_assoc()):
                    ?>

                    <div class="d-flex justify-content-between mb-2">
                        <span>
                            <?php echo htmlspecialchars($item['product_name']); ?> 
                            x <?php echo $item['qty']; ?>
                        </span>
                        <span>₹<?php echo number_format($item['price'] * $item['qty']); ?></span>
                    </div>

                    <?php endwhile; ?>

                </div>

                <!-- TOTAL -->
                <div class="d-flex justify-content-between mt-3 border-top pt-3">
                    <strong>Total</strong>
                    <strong class="text-primary">
                        ₹<?php echo number_format($order['total_amount']); ?>
                    </strong>
                </div>

                <!-- EXTRA -->
                <div class="mt-3 d-flex justify-content-between align-items-center">

                    <small class="text-muted">
                        Txn: <?php echo $order['txn_id']; ?>
                    </small>

                    <button class="btn btn-sm btn-outline-primary">
                        View Details
                    </button>

                </div>

            </div>

            <?php endwhile; ?>

        <?php endif; ?>

    </div>

</div>
```

</div>

<?php include '../components/footer.php'; ?>
