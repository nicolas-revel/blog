<?php
require('../config/header.php');
require('../app/views/Article.php');
//require('../app/controllers/Comment.php');
require('../app/views/Comment.php');
$articlesTable = new blog\app\views\Article();
//$comment = new blog\app\controllers\Comment();
$showComment = new blog\app\views\Comment();
?>
<?= $articlesTable->showOneArticle(); ?>
<br>
<h2>Commentaires :</h2>
<?= $showComment->showCommentWithArticle($_GET['id']); ?>
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
        $showComment->insertComments($_GET['id'], 1);
    }
    ?>
</form>

