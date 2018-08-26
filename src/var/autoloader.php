<?php

spl_autoload_register(function ($className) {
    $filePath = '../' . str_replace('\\', '/', $className) . '.php';
    if (!is_file($filePath)) {
        throw new \Exception\ClassNotFoundException($className);
    }

    /** @noinspection PhpIncludeInspection */
    include $filePath;
});
