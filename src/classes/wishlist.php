<?php

class Wishlist
{
    use Singleton;

    public function __construct()
    {
        if (!isset($_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = [];
        }
    }

    function clearwishlist()
    {
        $_SESSION['wishlist'] = [];
    }

    function countProductsWishlist()
    {
        $count = 0;

        if(isset($_SESSION['wishlist'])) {
            foreach($_SESSION['wishlist'] as $productId => $product) {
                $count += $product['count'];
            }
        }
        return $count;
    }

    function addProductWishlist($productId)
    {
         $_SESSION['wishlist'][$productId]['count'] = 1;
    }
    function updateProductWishlist($productId, $quantity)
    {
        if(isset($_SESSION['wishlist']) && isset($_SESSION['wishlist'][$productId])) {
            if($quantity > 0) {
                $_SESSION['wishlist'][$productId]['count'] = $quantity;
            } else {
                unset($_SESSION['wishlist'][$productId]);
            }
        }

    }

    function getProductsWishlist()
    {
        $products = [];

        if(isset($_SESSION['wishlist'])) {
            foreach($_SESSION['wishlist'] as $productId => $p) {
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

    function removeProductWishlist($productId)
    {
        unset($_SESSION['wishlist'][$productId]);
    }


}