<?php

// ERROR and Exception Handling configuration

// handle all PHP exceptions
set_exception_handler(function(Throwable $e) {
    $errorMessage = "\n\n";
    $errorMessage .= "ERROR MESSAGE: " . $e->getMessage() . "\n";
    $errorMessage .= "ERROR FILE: " . $e->getFile() . "\n";
    $errorMessage .= "ERROR LINE: "  . $e->getLine() . "\n";
    $errorMessage .= "ERROR CODE: " . $e->getCode() . "\n";

    error_log($errorMessage, 4);
    header('Location: /error');
});

// translate all old PHP Errors to PHP Exceptions
set_error_handler(function($severity, $message, $file, $line) {
    throw new \ErrorException($message, 0, $severity, $file, $line);
});
