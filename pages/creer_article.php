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
<h1>FORMULAIRE ARTICLE</h1>
<form id="creer_article" action="creer_article.php" method="POST">
    <br>
    <div>
        <label for="article" class="form-label">Article :</label>
        <input type="textarea" class="form-control" name="article" required>
    </div>
    <br>
    <div>
        <label for="categorie">Categorie :</label>
        <select for="categorie" name="categorie">
            <option>Boucle PHP</option>
        </select>
    </div>
    <br>
    <div>
        <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
    </div>
</form>
</body>
</html>
