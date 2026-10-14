<?php
/**
 * GiveGo Class Autoloader
 * Automatically registers and loads all OOP classes from the classes/ directory.
 */
spl_autoload_register(function ($className) {
    $file = __DIR__ . '/' . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
