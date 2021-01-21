<?php

namespace blog\app;

class Renderer {

    public static function render (string $path)
    {
        ob_start();
        require('pages/'. $path . '.php');
        $pageContent = ob_get_clean();

        require('pages/template.php');
    }

}