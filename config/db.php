<?php
// Hide errors from user screen
// ini_set('display_errors', 0); 
// mysqli_report(MYSQLI_REPORT_OFF);

$host = "sql12.freesqldatabase.com";
$user = "sql12823434";
$pass = "KAuWEryU1l"; 
$dbname = "sql12823434";
// $socket = "/home/user/.mysql/mysql.sock";

// 1. Try to connect
$conn = @new mysqli($host, $user, $pass, $dbname, 3306);

// 2. CHECK if it failed. 
// If there is a connect_errno, the object is useless, so we set is_demo to true.
if ($conn->connect_errno) {
    $is_demo = true;
    $conn = false; // Destroy the "closed" object so we don't try to use it
} else {
    $is_demo = false;
}

// --- FUNCTIONS ---

function getProducts($conn, $is_demo) {
    if (!$is_demo && $conn instanceof mysqli) {
        $result = $conn->query("SELECT * FROM products");
        if ($result) return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Return Demo Data if DB fails
    return [
        ['name' => 'Demo MacBook Pro', 'price' => '2499', 'icon' => '💻'],
        ['name' => 'Demo Sony Headphones', 'price' => '399', 'icon' => '🎧'],
        ['name' => 'Demo iPhone 15', 'price' => '999', 'icon' => '📱']
    ];
}

function getCategories($conn, $is_demo) {
    if (!$is_demo && $conn instanceof mysqli) {
        $result = $conn->query("SELECT * FROM categories");
        if ($result) return $result->fetch_all(MYSQLI_ASSOC);
    }
    return [
        ['id' => 1, 'name' => 'Computers'],
        ['id' => 2, 'name' => 'Audio'],
        ['id' => 3, 'name' => 'Mobile']
    ];
}

function attemptLogin($conn, $is_demo, $email, $password) {
    if (!$is_demo && $conn instanceof mysqli) {
        $stmt = $conn->prepare("SELECT id, name FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    if ($email != "" && $password != "") {
        return ['id' => 99, 'name' => 'Sanskar (Demo Mode)'];
    }
    return false;
}
?>