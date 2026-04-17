<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/style.css" rel="stylesheet">

<style>
.navbar-minimal {
    background: #fff;
    border-bottom: 1px solid #eee;
}

.search-input {
    height: 42px;
    font-size: 14px;
}

.badge-pulse {
    font-size: 10px;
}

.btn-primary-custom {
    background: #4f46e5;
    color: #fff;
    border: none;
}

.btn-primary-custom:hover {
    background: #4338ca;
}

@media (max-width: 991px) {
    .search-box {
        width: 100%;
        margin: 10px 0;
    }
}
</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-minimal py-3">
<div class="container">

<a class="navbar-brand fw-bolder text-primary fs-3" href="index.php">IDX.</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarContent">

<div class="search-box mx-lg-auto d-lg-block" style="max-width: 400px;">
<form action="products.php" method="GET" class="search-box mx-lg-auto">
    <input 
        type="text" 
        name="q" 
        class="form-control search-input rounded-pill px-4" 
        placeholder="Search for gear..."
        value="<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>"
    >
</form>
</div>

<ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-lg-center">

    <li class="nav-item">
        <a class="nav-link fw-medium px-3" href="../index.php">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link fw-medium px-3" href="../products.php">Products</a>
    </li>

    <li class="nav-item">
        <a class="nav-link fw-medium position-relative px-3" href="../cart.php">
            Cart
            <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary badge-pulse">
            <!-- <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?> -->
             0
            </span>
        </a>
    </li>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_logged_in']): ?>
        <li class="nav-item">
            <a class="nav-link fw-medium px-3" href="../user/orders.php">Orders</a>
        </li>
    <?php endif; ?>

</ul>

<div class="d-flex align-items-lg-center gap-2 flex-column flex-lg-row">

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_logged_in']): ?>

    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold text-dark px-3" href="#" data-bs-toggle="dropdown">
                <?php echo $_SESSION['user']['name']; ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                <li><a class="dropdown-item py-2" href="<?php echo $BASE_URL; ?>user">My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="<?php echo $BASE_URL; ?>user/logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>

    <?php else: ?>

    <a href="login.php" class="btn btn-outline-primary btn-sm rounded-pill px-4">Login</a>
    <a href="signup.php" class="btn btn-primary-custom btn-sm rounded-pill px-4">Signup</a>

    <?php endif; ?>

</div>

</div>
</div>
</nav>

<?php if ($is_demo): ?>

<div class="container mt-3">
    <div class="alert alert-warning border-0 shadow-sm rounded-4">
        <strong>⚠️ Offline Mode:</strong> Showing demo products.
    </div>
</div>
<?php endif; ?>

