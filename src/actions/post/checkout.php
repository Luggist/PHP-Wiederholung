<?php

$_SESSION['flash'] = [
    "old"   => [],
    "error" => []
];

$requiredFields = ['name', 'street', 'place', 'country', 'confirmation',];
foreach($requiredFields as $field) {
    if(!isset($_POST[$field]) || empty($_POST[$field])) {
        $_SESSION['flash']['error'][$field] = true;
    } else {
        $_SESSION['flash']['old'][$field] = $_POST[$field];
    }
}
if(!isset($_POST['captcha']) || empty($_POST['captcha']) || $_POST['captcha']!=$_SESSION["captcha_text"]){
    $_SESSION['flash']['error']['captcha'] = true;
}

// ACTION: CHECKOUT
if (empty($_SESSION['flash']['error'])) {
    unset($_SESSION['flash']);

    $checkout = [];
    $arrayKeysCheckout = array_filter($requiredFields, function($var) {
        return $var !== 'confirmation';
    });

    foreach($arrayKeysCheckout as $key) {
        $checkout[$key] = $_POST[$key];
    }
    $checkout['total'] = Cart::instance()->getTotalCart();

    $data['checkout'] = $checkout;
    $data['cart'] = Cart::instance()->getProductsCart();

    Order::instance()->addOrder($data);
    Cart::instance()->clearCart();

    header('Location: /success');

// Formular unvollständig
} else {
    header('Location: /checkout');
}