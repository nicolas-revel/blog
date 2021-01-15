<?php

class Renderer {

    public static function render (string $path, array $variables = [])
    {
        extract($variables);
        ob_start();
        require('config/'. $path . '.php');
        $pageContent = ob_get_clean();

        require('config/header.php');
    }

}