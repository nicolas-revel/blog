<?php
require_once('../app/Autoload.php');
session_start();
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

<main>
    <section id="info_articles">
        <h2 id="title_blogout2"><span class="bw">A</span><span class="bw">r</span><span class="bw">t</span><span class="bw">i</span><span class="bw">c</span><span class="bw">l</span><span class="bw">e</span><span class="bw">s</span></h2>
            <p>Une mixture de tous les articles.<br>N'hésites pas à filtrer les articles par catégorie et bonne lecture !</p>
    </section>

    <section id="showArticles">
    <?php if(isset($_GET['categorie'])): ?>
        <article class="articlePagination">
            <div class="card_articles"><?php $pages = $articlesTable->showArticleByCategorie($currentPage); ?></div>
        </article>
    <?php elseif(!isset($_GET['categorie'])): ?>
        <article class="articlePagination">
                <div class="card_articles"><?php $pages = $articlesTable->showArticleArticles($currentPage); ?></div>
        </article>
    <?php endif; ?>

    <div id="box_filter">
        <div id="filter">
            <h3 id="title_filter">CATEGORIES</h3>
            <?= $nameCat->showFiltre(); ?>
        </div>
        <a href="articles.php" class="card-link"><button id="button_back" type="button" class="btn btn-light">RETOUR ARTICLES</button></a>
    </div>
    </section>
</main>

<?php require_once('../config/footer.php'); ?>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>





