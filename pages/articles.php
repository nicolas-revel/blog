<?php

use App\Controller\ArticleController;
use App\Controller\CategoryController;
use App\Entity\Article;

require_once('../config/env.php');
require_once('../config/autoload.php');
session_start();

$articleController = new ArticleController();
$categoryController = new CategoryController();

/** @var Article[] $articles */
$articles = $articleController->getFilteredArticles(
    $_GET['page'] ?? 1,
    $_GET['categorie'] ?? null
);

$pages = $articleController->getPagination(
    $_GET['categorie'] ?? null
);

$categories = $categoryController->getAllCategories();

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int)strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

if (isset($_GET['deleart'])) {
    $deleteArt = $art->deletArticle($_GET['deleart']);
    app\Http::redirect('articles.php');
}

?>
<?php
$pageTitle = 'ARTICLES'; ?>
<?php
ob_start(); ?>
<?php
require_once('../config/header.php'); ?>

    <main>
        <section id="info_articles">
            <h2 id="title_blogout2"><span class="bw">A</span><span class="bw">r</span><span class="bw">t</span><span
                        class="bw">i</span><span class="bw">c</span><span class="bw">l</span><span
                        class="bw">e</span><span class="bw">s</span></h2>
            <p>Une mixture de tous les articles.<br>N'hésites pas à filtrer les articles par catégorie et bonne lecture
                !</p>
        </section>

        <section id="showArticles">
            <article class="articlePagination">
                <div class="card_articles">
                    <?php
                    foreach ($articles as $article): ?>
                        <div id="card_accueil">
                            <div id="card_title">
                                <h5><i id="i_title" class="fas fa-project-diagram"></i><?= $article->getTitle() ?>
                                </h5>
                                <span id="title_h6">Ecrit le : <?= $article->getCreatedAt()->format('d/m/y H:i') ?> par : <?= $article->getAuthor(
                                    )->getFullName() ?></span>
                            </div>
                            <div id="card_articleText">
                                <p><?= $article->getTitle() ?></p>
                            </div>
                            <div id="card_button">
                                <a class="buttonCard"
                                   href="articles.php?categorie=<?= $article->getCategory()->getId() ?>"
                                   class="card-link"><?= $article->getCategory()->getName() ?></a>
                                <a class="buttonCard" href="article.php?id=<?= $article->getId() ?>" class="card-link">VOIR
                                    L'ARTICLE</a>
                                <?php
                                if (isset($_SESSION['user']) && $_SESSION['user']->getIdRight() == 42): ?>
                                    <a class="buttonCard" href="creer_article.php?modifart=<?= $article->getId() ?>"
                                       class="card-link">MODIFIER L'ARTICLE</a>
                                    <a class="buttonCard" href="articles.php?deleart=<?= $article->getId() ?>"
                                       class="card-link">SUPPRIMER L'ARTICLE</a>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </article>
            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a href="<?= 'articles.php?page=' . $currentPage - 1 ?>" class="page-link">Précédente</a>
                    </li>
                    <?php
                    for ($page = 1; $page <= $pages; $page++): ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                            <a href="<?= 'articles.php?page=' . $page ?>" class="page-link"><?= $page ?></a>
                        </li>
                    <?php
                    endfor ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a href="<?= 'articles.php?page=' . $currentPage + 1 ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
            <div id="box_filter">
                <div id="filter">
                    <h3 id="title_filter">CATEGORIES</h3>
                    <?php
                    foreach ($categories as $category): ?>
                        <a id='filtre_categorie'
                           href='articles.php?categorie=<?= $category->getId() ?>'><?= $category->getName() ?></a><br>
                    <?php
                    endforeach; ?>
                </div>
                <a href="articles.php" class="card-link">
                    <button id="button_back" type="button" class="btn btn-light">RETOUR ARTICLES</button>
                </a>
            </div>
        </section>
    </main>

<?php
require_once('../config/footer.php'); ?>

<?php
$pageContent = ob_get_clean(); ?>

<?php
require_once('template.php'); ?>