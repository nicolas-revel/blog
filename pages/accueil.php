<?php

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Entity\User;

require_once('../config/env.php');
require_once('../config/autoload.php');
session_start();

$homeController = new HomeController();

/** @var [Article] $articles */
$articles = $homeController->getHomepageArticles();
$articles = array_slice($articles, 0, 5);

if (isset($_SESSION['user'])) {
    /** @var User $currentUser */
    $currentUser = $_SESSION['user'];
}

if (isset($_POST['deco'])) {
    $authController = new AuthController();
    $authController->logout();
}

$pageTitle = 'ACCUEIL';

ob_start();

require_once('../config/header.php');
?>

    <main>
        <section id="present_blog">
            <div id="avatars">
                <img id="avatarNico" src="../images/avatarnico.jpg">
                <img id="avatarEmma" src="../images/avataremma.jpg">
            </div>
            <div id="elementColumn">
                <h2 id="title_blogout"><span class="bw">H</span><span class="bw">e</span><span class="bw">l</span><span
                            class="bw">l</span><span class="bw">o</span> <span class="bw">W</span><span
                            class="bw">o</span><span class="bw">r</span><span class="bw">l</span><span
                            class="bw">d</span><span class="bw">!</span></h2>
                <p id="presentBlog">bLogOut est un petit blog créé par <strong>Nicolas
                        REVEL</strong> et <strong>Emma LAPREVOTE</strong>,
                    tout deux étudiants au sein de l'école La Plateforme et
                    passionnés par le développement web.
                    Ce blog est une vue généralisé de tout ce qui se passe dans
                    l'univers du web, sur leurs expériences tout au long de leurs
                    l'apprentissages, afin de partager
                    leurs vécus avec vous tous.
                </p>
            </div>
        </section>
        <section id="info_user">
            <i class="fas fa-user-astronaut"></i>
            <h6 id="login_user">BIENVENUE <?php
                if (!empty($_SESSION['user'])) :
                    ?><?= $_SESSION['user']->getFullName(); ?><?php
                endif; ?> !</h6>
            <div id="link_user">
                <?php
                if (
                    !empty($_SESSION['user']) && $_SESSION['user']->getIdRight()
                    == 1
                ) : ?>
                    <a href="profil.php">
                        <button id="button_user" type="button" class="btn btn-outline-light">PROFIL
                        </button>
                    </a>
                    <a href="articles.php">
                        <button id="button_user" type="button" class="btn btn-outline-light">VOIR ARTICLES</button>
                    </a>
                <?php
                elseif (
                    !empty($_SESSION['user']) &&
                    $_SESSION['user']->getIdRight() == 1337
                ) : ?>
                    <a href="ticle.php">
                        <button id="button_user" type="button" class="btn btn-outline-light">ECRIRE UN ARTICLE
                        </button>
                    </a>
                    <a href=".php">
                        <button id="button_user" type="button" class="btn btn-outline-light">VOIR ARTICLES
                        </button>
                    </a>
                    <a href="p">
                        <button id="button_user" type="button" class="btn btn-outline-light">ADMIN
                        </button>
                    </a>
                <?php
                elseif (
                    !empty($_SESSION['user']) &&
                    $_SESSION['user']->getIdRight() == 42
                ) : ?>
                    <a href="ticle.php">
                        <button id="button_user" type="button" class="btn btn-outline-light">ECRIRE UN ARTICLE
                        </button>
                    </a>
                    <a href=".php">
                        <button id="button_user" type="button" class="btn btn-outline-light">VOIR ARTICLES
                        </button>
                    </a>
                <?php
                else : ?>
                    <a href="ion.php">
                        <button id="button_user" type="button" class="btn btn-outline-light">INSCRIPTION
                        </button>
                    </a>
                    <a href="n.php">
                        <button id="button_user" type="button" class="btn btn-outline-light">CONNEXION
                        </button>
                    </a>
                <?php
                endif; ?>
            </div>
            <?php
            if (!empty($_SESSION['user'])) : ?>
                <form id="deleteUser" action="accueil.php" method="POST">
                    <button id="deco" name="deco" type="submit" class="btn
            btn-light">DECONNEXION
                    </button>
                </form>
            <?php
            endif; ?>
        </section>

        <article id="LastArticle">
            <h3 id="title_lastArticle">Derniers articles...</h3>
            <p id="text_lastArticle">Les trois derniers articles mis en ligne, vous
                pouvez retrouvez l'intégralité des articles<a class="buttonCard" href="articles.php" class="card-link">Here!</a>
            </p>
        </article>

        <div class="card_articles">
            <?php
            foreach ($articles as $article): ?>
                <div id="card_accueil">
                    <div id="card_title">
                        <h5><i id="i_title" class="fas fa-project-diagram"></i><?= $article->getTitle(); ?></h5>
                        <span id="title_h6">Ecrit le : <?= $article->getCreatedAt()->format(
                                'd/m/y H:i'
                            ) ?> par : <?= $article->getAuthor()->getFullName() ?></span>
                    </div>
                    <div id="card_articleText">
                        <p><?= $article->getTitle() ?></p>
                    </div>
                    <div id="card_button">
                        <a class="buttonCard" href="articles.php?categorie=<?= $article->getIdCategory() ?>"
                           class="card-link"><?= $article->getCategory()->getName() ?></a>
                        <a class="buttonCard" href="article.php?id=<?= $article->getId() ?>" class="card-link">VOIR
                            L'ARTICLE</a>
                        <?php
                        if (isset($_SESSION['user']) && $_SESSION['user']->getIdRight() == 42): ?>
                            <a class="buttonCard" href="creer_article.php?modifart=<?= $article->getId() ?>"
                               class="card-link">MODIFIER
                                L'ARTICLE</a>
                            <a class="buttonCard" href="articles.php?deleart=<?= $article->getId() ?>"
                               class="card-link">SUPPRIMER
                                L'ARTICLE</a>
                        <?php
                        endif; ?>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>

    </main>

<?php
require_once('../config/footer.php');

$pageContent = ob_get_clean();

require_once('template.php'); ?>