<?php

require_once __DIR__ . "/../config/config.php";

// SESSION starten
// Entweder neue Session wird gestartet oder bestehende geladen
session_start();

// CONVENTION OVER CONFIGURATION:
$path   = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// 1. if path is empty or just / set path as home
if (in_array($path, ['/', ''])) {
    $path = "home";
}

// 2. action is a combination of HTTP-Method and URI-Path
$action = strtolower($method . "/" . $path);
$file = __DIR__ . "/../src/actions/" . $action . ".php";

// 3. check if action $file exists, otherwise load not-found action
if (!is_file($file)) {
    $file = __DIR__ . "/../src/actions/get/not-found.php";
}

// 4. load action $file
include_once $file;







