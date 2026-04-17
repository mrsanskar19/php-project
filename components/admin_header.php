<?php
    include "../config/init.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | IDX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { background: #f4f7f6; }
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            background: #00002a; /* Your deep navy */
            color: white;
            padding-top: 20px;
        }
        .main-content { margin-left: 260px; padding: 30px; }
        .nav-link-admin {
            color: rgba(255,255,255,0.7);
            padding: 12px 25px;
            display: block;
            text-decoration: none;
            transition: 0.3s;
        }
        .nav-link-admin:hover, .nav-link-admin.active {
            color: white;
            background: rgba(255,255,255,0.1);
            border-left: 4px solid #0d6efd;
        }
    </style>
</head>
<body>

<div class="sidebar shadow">
    <div class="px-4 mb-4">
        <h4 class="fw-bold text-white"><span style="letter-spacing: -1px;">IDX</span> ADMIN</h4>
    </div>
    <nav>
        <a href="<?php echo $BASE_URL; ?>admin" class="nav-link-admin active">📊 Dashboard</a>
        <a href="<?php echo $BASE_URL; ?>admin/manage_products.php" class="nav-link-admin">📦 Products</a>
        <a href="<?php echo $BASE_URL; ?>admin/manage_orders.php" class="nav-link-admin">📜 Orders</a>
        <a href="<?php echo $BASE_URL; ?>admin/manage_users.php" class="nav-link-admin">👥 Users</a>
        <hr class="mx-3 opacity-25">
        <a href="../index.php" class="nav-link-admin">🌐 View Website</a>
        <a href="<?php echo $BASE_URL; ?>uesr/logout.php" class="nav-link-admin text-danger">🚪 Logout</a>
    </nav>
</div>

<div class="main-content">