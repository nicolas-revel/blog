<?php

spl_autoload_register(function($className)
{
    $className = $_ENV['ROOT_DIR'] . DIRECTORY_SEPARATOR . str_replace(['App', '\\'], ['src', DIRECTORY_SEPARATOR], $className) . '.php';
    if (file_exists($className)) {
        require $className;
    }
});



