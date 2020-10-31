<?php

$public_dir = __DIR__ . '/../public';

if (file_exists($public_dir . $_SERVER['REQUEST_URI']))
    return false;

$_SERVER['SCRIPT_NAME'] = 'index.php';
require($public_dir . '/index.php');