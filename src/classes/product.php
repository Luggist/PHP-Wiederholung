<?php

class Product
{
    use Singleton;

    protected $pdo;

    function __construct()
    {
        $this->pdo = getPDO();
    }

    function addProduct(array $data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (name, description, image, price) VALUES (:name, :description, :image, :price)");
        return $stmt->execute($data);
    }

    function getAllProducts()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM products');
        $stmt->execute();
        return $stmt->fetchAll();

    }

    function getProduct($productId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM products WHERE id = ?");
        $statement->execute([$productId]);
        return $statement->fetch();
    }
}