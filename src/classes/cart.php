<?php

class Cart
{
    use Singleton;

    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    function clearCart()
    {
        $_SESSION['cart'] = [];
    }

    function countProductsCart()
    {
        $count =0;

        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $productId => $product) {
                $count += $product['count'];
            }
        }
        return $count;
    }

    function addProductCart($productId)
    {

        if(isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['count'] ++;
        } else {
            $_SESSION['cart'][$productId]['count'] = 1;
        }
    }
    function updateProductCart($productId, $quantity)
    {
        if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$productId])) {
            if($quantity > 0) {
                $_SESSION['cart'][$productId]['count'] = $quantity;
            } else {
                unset($_SESSION['cart'][$productId]);
            }
        }

    }

    function getProductsCart()
    {
        $products = [];

        if(isset($_SESSION['cart'])) {
            foreach($_SESSION['cart'] as $productId => $p) {
                $product = product::instance()->getProduct($productId);
                if(!$product) continue;
                $total = $p['count'] * $product['price'];
                array_push($products, [
                    "id" => $productId,
                    "name" => $product['name'],
                    "quantity" => $p['count'],
                    "price" => $product['price'],
                    "total" => $total
                ]);
            }
        }
        return $products;
    }

    function getTotalCart()
    {
        $total = 0;
        foreach($this->getProductsCart() as $product) {
            $total + $product['total'];
        }
        return $total;
    }


}

