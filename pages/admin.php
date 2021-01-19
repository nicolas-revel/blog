<?php

require_once('../app/Autoload.php');
$nameCat = new \blog\app\views\categorie;
$user =new blog\app\controllers\User();
if (empty($_GET['table'])) {
    $_GET['table'] = "users";
}

if (isset($_POST['submit'])) {
    $user->updateUserDroit($_POST['droituser'], $_POST['userid']);
}
if (isset($_GET['del'])) {
    $user->deleteUser($_GET['del']);
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php require_once('../config/header.php')?>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>
</body>
</html>