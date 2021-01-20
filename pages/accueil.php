<?php
require_once('../app/Autoload.php');
$show = new blog\app\views\Article();
?>

<?php $pageTitle = 'ACCUEIL'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main id="homeArticles">

    <section id="present_blog">
        <div id="avatars">
            <img id="avatarNico" src="../images/avatarnico.jpg">
            <img id="avatarEmma" src="../images/avataremma.jpg">
        </div>
        <div id="elementColumn">
            <h2 id="title_blogout">Hello World!</h2>
            <p id="presentBlog">bLogOut est un petit blog créé par Nicolas REVEL et Emma LAPREVOTE,
                tout deux étudiants au sein de l'école La Plateforme et passionnés par le développement web.
            Ce blog est une vue généralisé de tout ce qui se passe dans l'univers du web, sur nos expériences tout au long de l'apprentissage.
            </p>
        </div>
    </section>

<div class="card_articles"><?= $show->showArticleAccueil(); ?></div>

<a href="articles.php">Articles</a>
</main>
<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>

