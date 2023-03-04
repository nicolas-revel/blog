<?php

namespace App\Controller;


class AbstractController
{

    public function index ()
    {
        Header('Location: pages/accueil.php?action=accueil');
    }

}