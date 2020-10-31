<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Funny Clothes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1><a href="/">Funny Clothes - Webshop</a></h1>
    <a class="btn" href="/cart">Warenkorb (<?php echo Cart::instance()->countProductsCart() ?>)</a>
    <a class="btn" href="/wishlist">Wunschliste</a>
</header>
<main>