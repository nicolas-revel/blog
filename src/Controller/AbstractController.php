<?php

namespace App\Controller;

abstract class AbstractController
{

    protected function redirect(string $url)
    {
        var_dump('Location: ' . $_ENV['ROOT_PROJECT'] . $url);
        header('Location: ' . $_ENV['ROOT_PROJECT'] . '/' . $url, true, 302);
    }
}