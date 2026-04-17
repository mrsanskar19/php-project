<?php
require '../vendor/autoload.php';
include '../config/init.php';

\Stripe\Stripe::setApiKey("");

// validate cart
$cart = json_decode($_POST['cart_data'], true);

if (!$cart || count($cart) === 0) {
    die("Cart is empty");
}

// generate txn
$txn_id = "TXN_" . time() . "_" . rand(1000,9999);

// collect checkout data
$first_name = trim($_POST['first_name'] ?? '');
$last_name  = trim($_POST['last_name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$address    = trim($_POST['address'] ?? '');
$city       = trim($_POST['city'] ?? '');
$pincode    = trim($_POST['pincode'] ?? '');

// 🔥 calculate total from cart (NOT from frontend)
$total_amount = 0;

foreach ($cart as $item) {
    $total_amount += $item['price'] * $item['qty'];
}

// store pending order
$_SESSION['pending_order'] = [
    "txn_id" => $txn_id,
    "cart" => $cart,
    "email" => $email,
    "name" => $first_name . ' ' . $last_name,
    "address" => $address,
    "city" => $city,
    "pincode" => $pincode,
    "amount" => $total_amount
];

// stripe line items
$line_items = [];

foreach ($cart as $item) {
    $line_items[] = [
        "price_data" => [
            "currency" => "inr",
            "product_data" => [
                "name" => $item['name'],
            ],
            "unit_amount" => $item['price'] * 100,
        ],
        "quantity" => $item['qty'],
    ];
}

// create stripe session
$session = \Stripe\Checkout\Session::create([
    "payment_method_types" => ["card"],
    "line_items" => $line_items,
    "mode" => "payment",

    "success_url" => $BASE_URL . "success.php?session_id={CHECKOUT_SESSION_ID}",
    "cancel_url" => $BASE_URL . "cancel.php",

    "metadata" => [
        "txn_id" => $txn_id,
        "user_id" => $_SESSION['user']['id'] ?? 0
    ]
]);

header("Location: " . $session->url);
exit;