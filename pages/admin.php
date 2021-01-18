<?php

require_once('../app/Autoload.php');
$user =new blog\app\controllers\User();
if (empty($_GET['table'])) {
    $_GET['table'] = "users";
}

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
<form action="admin.php" method="get">
    <select id="table" name="table">
        <option value=""></option>
        <option value="users">Utilisateurs</option>
        <option value="art">Articles</option>
    </select>
    <input type="submit" value="Filtrer" name="filter" id="filter">
</form>
<?= $user->chooseAdminTab($_GET['table']) ?>

</body>
</html>