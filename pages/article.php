<?php
require_once('../app/Autoload.php');
$articlesTable = new blog\app\views\Article();
$showComment = new blog\app\views\Comment();
$com = new \blog\app\controllers\Comment();

if (isset($_GET['start']) && !empty($_GET['start'])) {
    $currentPage = (int)strip_tags($_GET['start']);
} else {
    $currentPage = 1;
}
if (isset($_GET['modifcom'])) {
    $modifcom = $com->getCommentBd($_GET['modifcom']);
}
 ?>
<?php $pageTitle = 'ARTICLES'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>
<?= $articlesTable->showOneArticle(); ?>
<br>
<h2>Commentaires :</h2>
<?php $pages = $showComment->showCommentWithArticle($currentPage); ?>
<div class="pagination"><?= $articlesTable->showPagination($url = "?id=", $get = $_GET['id'], $start = "&start=", $currentPage, $pages); ?></div>
<br>
<br>

<h1>FORMULAIRE COMMENTAIRE</h1>
<form id="article" action="article.php?id=<?= $_GET['id']; ?><?php if (isset
($_GET['modifcom'])) : echo "&modifcom={$_GET['modifcom']}"; endif; ?>"
method="POST">
    <div>
        <label for="commentaire">Commentaire</label>
        <input type="text" name="commentaire" required
               placeholder="Commentaire" value="<?php if (!empty($modifcom))
            : echo $modifcom['commentaire']; endif; ?>">
    </div>
    <br>
    <div>
        <?php if (empty($modifcom)) : ?>
            <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
        <?php else : ?>
            <button id="buttonSub" type="submit" name="majcom">Envoyer</button>
        <?php endif; ?>
    </div>
    <?php if (isset($_POST['envoyer'])) {
        $showComment->insertComments($_GET['id'], 1);
    }
    if (isset($_POST['majcom']) && isset($modifcom)) {
        $com->updateComments($modifcom['id'], $modifcom['id_article'],
            $modifcom['id_utilisateur']);
    }
    ?>
</form>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>

