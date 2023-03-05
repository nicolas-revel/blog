<?php

namespace App\Controller;

abstract class AbstractController
{

    protected function redirect(string $url)
    {
        header('Location: ' . $_ENV['ROOT_PROJECT'] . '/' . $url, true, 302);
    }
}