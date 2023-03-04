<?php
try
{
    require_once './config/env.php';
    require_once './config/autoload.php';

    $controller = new \App\Controller\AbstractController();

    if (!empty($_GET['page']))
    {
        if ($_GET['page'] == 'accueil')
        {
            $controller->index();
        }
    }

    else
    {
        $controller->index(); // Action par défaut;
    }
}

catch (Exception $e)
{
    die('Error: ' . $e);
}
