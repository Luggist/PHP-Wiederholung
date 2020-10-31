<?php

const ROOT_DIR = __DIR__ . "/../";
const DSN = "sqlite:" . ROOT_DIR . "webshop.db";

/**
 * @return \PDO
 */
function getPDO()
{
    return new \PDO(DSN);
}

function createDB()
{
    $pdo = getPDO();

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT NOT NULL,
            image TEXT NOT NULL,
            price REAL
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            street TEXT NOT NULL,
            place TEXT NOT NULL,
            country TEXT NOT NULL,
            total REAL NOT NULL
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS order_items (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            order_id INTEGER NOT NULL,
            product_id INTEGER NOT NULL,
            quantity INTEGER NOT NULL,
            price REAL NOT NULL,
            total REAL NOT NULL,
            FOREIGN KEY (order_id) REFERENCES orders(id),
            FOREIGN KEY (product_id) REFERENCES products(id)
        );
    ");
}
