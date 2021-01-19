<?php
require_once('../app/Autoload.php');
$articlesTable = new blog\app\views\Article();
$showComment = new blog\app\views\Comment();
$pagination = new blog\app\views\view();

if(isset($_GET['start']) && !empty($_GET['start'])){
    $currentPage = (int) strip_tags($_GET['start']);
}else{
    $currentPage = 1;
}
?>
<?php $pageTitle = 'ARTICLES'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>
<?= $articlesTable->showOneArticle(); ?>
<br>
<h2>Commentaires :</h2>
<?php $pages = $showComment->showCommentWithArticle($currentPage); ?>
<div class="pagination"><?= $pagination->showPagination($url = "?id=", $get = $_GET['id'], $start = "&start=", $currentPage, $pages); ?></div>
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

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>

