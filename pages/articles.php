<?php
require_once('../app/Autoload.php');
$nameCat = new blog\app\views\Categorie();
$articlesTable = new blog\app\views\Article();
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

    <div>
        <h3>Filtrer par categorie:</h3>
            <?= $nameCat->showFiltre(); ?>
    </div>
<br>
    <?php if(isset($_GET['categorie'])): ?>
        <div id="card_article"><?php $pages = $articlesTable->showArticleByCategorie($currentPage); ?></div>
    <br>
        <div class="pagination"><?= $pagination->showPagination($url = "?categorie=", $get = $_GET['categorie'], $start = "&start=", $currentPage, $pages); ?></div>

    <?php elseif(!isset($_GET['categorie'])): ?>
            <div id="card_articles"><?php $pages = $articlesTable->showArticleArticles($currentPage); ?></div>
        <br>
            <div class="pagination"><?= $pagination->showPagination(null, null, $start = "?start=", $currentPage, $pages); ?></div>
    <?php endif; ?>


<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>





