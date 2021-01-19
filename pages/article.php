<?php
require('../config/header.php');
require_once('../app/Autoload.php');
$articlesTable = new blog\app\views\Article();
$showComment = new blog\app\views\Comment();
?>
<?= $articlesTable->showOneArticle(); ?>
<br>
<h2>Commentaires :</h2>
<?= $showComment->showCommentWithArticle(); ?>
<br>
<br>
<h1>FORMULAIRE COMMENTAIRE</h1>
<form id="article" action="article.php?id=<?= $_GET['id']; ?>" method="POST">
    <div>
        <label for="commentaire">Commentaire</label>
        <input type="text" name="commentaire" required placeholder="Commentaire">
    </div>
    <br>
    <div>
        <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
    </div>
    <?php if(isset($_POST['envoyer'])){
        //$showComment->insertComments($_GET['id'], 1);
        $showComment->updateComments(5, $_GET['id'], 2);
    }
    ?>
</form>

