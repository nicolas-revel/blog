<?php
session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>FORMULAIRE DE CONNEXION</h1>
<form id="connexion" action="connexion.php" method="POST">
    <br>
    <div>
        <label for="login" class="form-label">Login *</label>
        <input type="text" class="form-control" name="login" required placeholder="Nom d'utilisateur">
    </div>
    <br>
    <div>
        <label for="password">password *</label>
        <input type="password" name="password" required placeholder="Mot de passe">
    </div>
    <br>
    <div class="col-12">
        <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
    </div>
</form>
</body>
</html>
