<?php

class Order
{
    use Singleton;

    protected $pdo;

    function __construct()
    {
        $this->pdo = getPDO();
    }

    function addOrder(array $data)
    {
        $checkout = $data['checkout'];
        $orderId = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare('INSERT INTO orders (name, street, place, country, total) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$checkout['name'], $checkout['street'], $checkout['place'], $checkout['country'], $checkout['total']]);

        foreach($data['cart'] as $product) {
            $stmt = $this->pdo->prepare('INSERT INTO order_items (order_id, product_id, quantity, price, total) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$orderId, $product['id'], $product['quantity'], $product['price'], $product['total']]);
        }

    }
}
