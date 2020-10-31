<?php

// ACTION: ADD PRODUCT
if (isset($_POST['add_product'])) {
    Cart::instance()->addProductCart($_POST['add_product']);
    header('Location: /');

// ACTION: UPDATE PRODUCT
} elseif (isset($_POST['update_product'])) {
    Cart::instance()->updateProductCart($_POST['update_product'], $_POST['quantity']);
    header('Location: /cart');

// ACTION: REMOVE PRODUCT
} elseif (isset($_POST['remove_product'])) {
    Cart::instance()->updateProductCart($_POST['remove_product'], 0);
    header('Location: /cart'); 
}
