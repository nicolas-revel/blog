<?php
require('../config/header.php');
require('../app/views/Article.php');
$articlesTable = new blog\app\views\Article();
?>
<?= $articlesTable->showOneArticle(); ?>

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

