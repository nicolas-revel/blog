<?php

namespace App\Controller;

class BaseController extends AbstractController
{

    public function redirect(string $url)
    {
        parent::redirect($url);
    }
}