<?php

require_once __DIR__ . "/../config/config.php";

// Tabellen in Datenbank erstellen
createDB();

$product = Product::instance();

$product->addProduct([
    'name' => 'Osterhasenkostüm' ,
    'description' => 'Ein schönes Kostüm für die ruhigen Tage.' ,
    'image' => 'images/p2.jpg' ,
    'price' => 44.99
]);

$product->addProduct([
    'name' => 'Osterhasenohren' ,
    'description' => 'Osterhasenohren für den Frühlingsbeginn.' ,
    'image' => 'images/p3.jpg' ,
    'price' => 8.99
]);

$product->addProduct([
    'name' => 'Nikolausmütze' ,
    'description' => 'Eine modische Mütze, dass die Ohren nicht kalt werden.' ,
    'image' => 'images/p1.jpg' ,
    'price' => 14.99
]);
