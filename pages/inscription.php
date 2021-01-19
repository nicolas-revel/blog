<?php

require_once('../app/Autoload.php');

$user = new \blog\app\controllers\User();
$nameCat = new \blog\app\views\categorie;

if (isset($_POST['envoyer'])) {
    $checklogin = \blog\app\controllers\User::checkLoginValidity($_POST['login']);
    $confirmedpass = \blog\app\controllers\User::checkPassword($_POST['password'], $_POST['c_password']);
    /* blog\app\controllers\User::checkPasswordFormat
    ($_POST['password']);
    $checkmailformat = \blog\app\controllers\User::checkMailFormat
    ($_POST['email']);*/
    if ($checklogin === true && $confirmedpass === true) {
        $user->insertUser($_POST['login'], $_POST['password'], $_POST['mail']);
    }
}
?>
<!doctype html>
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
<?php require_once('../config/header.php'); ?>
<h1>FORMULAIRE D'INSCRIPTION</h1>
<form id="inscription" action="inscription.php" method="POST">
    <br>
    <div>
        <label for="login" class="form-label">Login *</label>
        <input type="text" class="form-control" name="login" required
               placeholder="Nom d'utilisateur">
    </div>
    <br>
    <div>
        <label for="mail">E-mail *</label>
        <input type="mail" name="mail" required placeholder="E-mail">
    </div>
    <br>
    <div>
        <label for="password">password *</label>
        <input type="password" name="password" required
               placeholder="Mot de passe">
    </div>
    <br>
    <div>
        <label for="c_password">Confirm password *</label>
        <input type="password" name="c_password" required
               placeholder="Mot de passe">
    </div>
    <br>
    <div class="col-12">
        <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script>

</body>
</html>
