<?php
// session_start();
// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// ini_set('log_errors', 1);
// mysqli_report(MYSQLI_REPORT_OFF);


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// helper
function isLoggedIn() {
    return isset($_SESSION['user']) && $_SESSION['user']['is_logged_in'];
}

function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: /php-project/user/login.php");
        exit;
    }
}
