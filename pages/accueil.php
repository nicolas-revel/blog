<?php
require_once('../app/Autoload.php');
session_start();
$currentUser = $_SESSION['user'];

$user = new \blog\app\controllers\User();
$show = new blog\app\views\Article();

?>

<?php $pageTitle = 'ACCUEIL'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>

    <section id="present_blog">
        <div id="avatars">
            <img id="avatarNico" src="../images/avatarnico.jpg">
            <img id="avatarEmma" src="../images/avataremma.jpg">
        </div>
        <div id="elementColumn">
            <h2 id="title_blogout"><span class="bw">H</span><span class="bw">e</span><span class="bw">l</span><span class="bw">l</span><span class="bw">o</span> <span class="bw">W</span><span class="bw">o</span><span class="bw">r</span><span class="bw">l</span><span class="bw">d</span><span class="bw">!</span></h2>
            <p id="presentBlog">bLogOut est un petit blog créé par <strong>Nicolas REVEL</strong> et <strong>Emma LAPREVOTE</strong>,
                tout deux étudiants au sein de l'école La Plateforme et passionnés par le développement web.
            Ce blog est une vue généralisé de tout ce qui se passe dans l'univers du web, sur leurs expériences tout au long de leurs l'apprentissages, afin de partager
                leurs vécus avec vous tous.
            </p>
        </div>
    </section>

    <section id="info_user">
        <i class="fas fa-user-astronaut"></i>
        <h6 id="login_user">BIENVENUE <?php if(!empty($_SESSION['user'])): ?><?= $currentUser->getLogin(); ?><?php endif; ?>!</h6>
        <div id="link_user">
        <button id="button_user" type="button" class="btn btn-outline-light">PROFIL</button>
        <button id="button_user" type="button" class="btn btn-outline-light">ECRIRE UN ARTICLE</button>
        <button id="button_user" type="button" class="btn btn-outline-light">ADMIN</button>
        </div>
        <form id="deleteUser" action="accueil.php" method="POST">
            <button id="delete" type="submit" class="btn btn-light">DECONNEXION</button>
        </form>
    </section>

    <article id="LastArticle">
        <h3 id="title_lastArticle">Derniers articles...</h3>
        <p id="text_lastArticle">Les trois derniers articles mis en ligne, vous pouvez retrouvez l'intégralité des articles<a class= "buttonCard" href="articles.php" class="card-link">Here!</a></p>
    </article>

<div class="card_articles"><?= $show->showArticleAccueil(); ?></div>

</main>

<?php require_once('../config/footer.php'); ?>
<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>

