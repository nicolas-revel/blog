<?php
require('../config/template.php');
require('../config/header.php');
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

<h1>FORMULAIRE COMMENTAIRE</h1>
<form id="article" action="article.php" method="POST">
    <div>
        <label for="commentaire">Commentaire</label>
        <input type="text" name="commentaire" required placeholder="Commentaire">
    </div>
    <br>
    <div>
        <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
    </div>
</form>
</body>
</html>
