<?php
require_once('../app/Autoload.php');
$nameCat = new blog\app\views\Categorie();
$articlesTable = new blog\app\views\Article();

if(isset($_GET['start']) && !empty($_GET['start'])){
    $currentPage = (int) strip_tags($_GET['start']);
}else{
    $currentPage = 1;
}
?>
<?php $pageTitle = 'ARTICLES'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main id="showArticles">
<br>
    <?php if(isset($_GET['categorie'])): ?>
        <article class="articlePagination">
            <div class="card_articles"><?php $pages = $articlesTable->showArticleByCategorie($currentPage); ?></div>
         <br>
            <div class="pagination"><?= $articlesTable->showPagination($url = "?categorie=", $get = $_GET['categorie'], $start = "&start=", $currentPage, $pages); ?></div>
        </article>
    <?php elseif(!isset($_GET['categorie'])): ?>
        <article class="articlePagination">
                <div class="card_articles"><?php $pages = $articlesTable->showArticleArticles($currentPage); ?></div>
            <br>
                <div class="pagination"><?= $articlesTable->showPagination(null, null, $start = "?start=", $currentPage, $pages); ?></div>
        </article>
    <?php endif; ?>

    <div>
        <div id="filter">
            <h3 id="title_filter">CATEGORIES <span id="fleche">&#9660</span></h3>
            <?= $nameCat->showFiltre(); ?>
        </div>
    </div>
</main>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>





