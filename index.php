<?php
try
{
    require_once 'app/Autoload.php';

    $controller = new \blog\app\controllers\Controller();

    if (!empty($_GET['action']))
    {
        $action = $_GET['action'];

        if ($action == 'accueil')
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
