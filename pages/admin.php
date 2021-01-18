<?php

require_once('../app/Autoload.php');
$user = new \blog\app\views\User();

?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Page d'administration</h1>
<h2>Table des utilisateurs</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Login</th>
        <th>Email</th>
        <th>Droits</th>
        <th>Modifier les Droits</th>
        <th>Supprimer l'utilisateur</th>
    </tr>
    <?= blog\app\views\User::listEachUsers() ?>
</table>
<h2>Table des articles</h2>
<table>
    
</table>
</body>
</html>