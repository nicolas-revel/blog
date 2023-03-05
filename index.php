<?php

use App\Controller\BaseController;

try {
    require_once './config/env.php';
    require_once './config/autoload.php';

    $controller = new BaseController();


    if (isset($_GET['page'])) {
        $controller->redirect('pages/' . $_GET['page']); // Action par défaut;
    } else {
        $controller->redirect('pages/accueil.php');
    }
} catch (Exception $e) {
    die('Error: ' . $e);
}
