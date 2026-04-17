<?php
include '../config/init.php';
requireLogin();

$user_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("SELECT name, email, phone, role, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

include '../components/header.php';
?>

<div class="container my-5">

<div class="row g-4">

    <!-- LEFT SIDEBAR -->
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
                <a href="./orders.php" class="btn btn-light text-start">📦 Orders</a>
                <a href="../cart.php" class="btn btn-light text-start">🛒 Cart</a>
                <a href="logout.php" class="btn btn-danger text-start">🚪 Logout</a>
            </div>

        </div>

    </div>

    <!-- RIGHT CONTENT -->
    <div class="col-lg-9">

        <!-- PROFILE FORM -->
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">Account Settings</h4>
                <small class="text-muted">Joined: <?php echo date("M Y", strtotime($user['created_at'])); ?></small>
            </div>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Profile updated successfully</div>
            <?php endif; ?>

            <form action="update_profile.php" method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="small fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" 
                            value="<?php echo htmlspecialchars($user['name']); ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-bold">Email</label>
                        <input type="email" class="form-control" 
                            value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-bold">Phone</label>
                        <input type="text" name="phone" class="form-control" 
                            value="<?php echo htmlspecialchars($user['phone']); ?>">
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-bold">Role</label>
                        <input type="text" class="form-control" 
                            value="<?php echo ucfirst($user['role']); ?>" disabled>
                    </div>

                </div>

                <button class="btn btn-primary mt-4 px-4">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

</div>

<?php include '../components/footer.php'; ?>
