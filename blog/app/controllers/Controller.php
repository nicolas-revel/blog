<?php

namespace blog\app\controllers;


class Controller
{

    public function index ()
    {
        Header('Location: pages/accueil.php?action=accueil');
    }




}