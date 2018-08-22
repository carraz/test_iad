<?php

spl_autoload_register(function ($class_name) {
    $filePath = '../' . str_replace('\\', '/', $class_name) . '.php';
    if (!is_file($filePath)) {
        throw new \Exception("Class $class_name not found");
    }

    /** @noinspection PhpIncludeInspection */
    include $filePath;
});
