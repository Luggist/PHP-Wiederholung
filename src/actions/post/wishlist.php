<?php

// ACTION: ADD PRODUCT
if (isset($_POST['add_product'])) {
    Wishlist::instance()->addProductWishlist($_POST['add_product']);
    header('Location: /');

// ACTION: REMOVE PRODUCT
} elseif (isset($_POST['remove_product'])) {
    Wishlist::instance()->updateProductWishlist($_POST['remove_product'], 0);
    header('Location: /wishlist');

// ACTION ADD TO Card
} elseif (isset($_POST['add_product_cart'])) {
    WishList::instance()->removeProductWishlist($_POST['add_product_cart']);
    Cart::instance()->addProductCart($_POST['add_product_cart']);
    header('Location: /wishlist');
}