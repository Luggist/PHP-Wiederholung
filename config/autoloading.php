<?php

// Autoloader definieren um Klassen zu laden
spl_autoload_register(function ($class_name) {
    require_once __DIR__ . "/../src/classes/" . strtolower($class_name) . '.php';
});