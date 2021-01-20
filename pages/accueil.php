<?php
require_once('../app/Autoload.php');
$show = new blog\app\views\Article();
?>

<?php $pageTitle = 'ACCUEIL'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main id="homeArticles">
<div class="card_articles"><?= $show->showArticleAccueil(); ?></div>

<a href="articles.php">Articles</a>
</main>
<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>

