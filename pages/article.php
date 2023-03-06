<?php

use App\Controller\ArticleController;
use App\Entity\Article;

require_once('../config/env.php');
require_once('../config/autoload.php');
session_start();

$articleController = new ArticleController();

/** @var Article $article */
$article = $articleController->getOneArticleWithComment($_GET['id']);

?>
<?php
$pageTitle = 'ARTICLE'; ?>
<?php
ob_start(); ?>
<?php
require_once('../config/header.php'); ?>

    <main>
        <section id="info_articles">
            <h2 id="title_blogout2"><span class="bw">A</span><span class="bw">r</span><span class="bw">t</span><span
                        class="bw">i</span><span class="bw">c</span><span class="bw">l</span><span class="bw">e</span>
            </h2>
            <p>A vos lunettes et bonne découverte.<br>N'hésites pas à commenter
                l'article!</p>
        </section>
        <section id="showArticle">
            <article class="articlePagination">
                <div class="card_articles">
                    <div id="card_accueil">
                        <div id="card_title">
                            <h5><i id="i_title" class="fas fa-project-diagram"></i><?= $article->getTitle(); ?></h5>
                            <span id="title_h6">Ecrit le : <?= $article->getCreatedAt()->format(
                                    'd/m/y H:i'
                                ) ?> par : <?= $article->getAuthor()->getFullName() ?></span>
                        </div>
                        <div id="card_articleText">
                            <p><?= $article->getContent(); ?></p>
                        </div>
                        <div id="card_button">
                            <a class="buttonCard" href="articles.php?categorie=<?= $article->getIdCategory() ?>"
                               class="card-link"><?= $article->getCategory()->getName(); ?></a>
                            <?php
                            if (isset($_SESSION['user']) && $_SESSION['user']->getIdRight() == 42): ?>
                                <a class="buttonCard" href="creer_article.php?modifart=<?= $article->getId() ?>"
                                   class="card-link">MODIFIER L'ARTICLE</a>
                                <a class="buttonCard" href="articles.php?deleart=<?= $article->getId() ?>"
                                   class="card-link">SUPPRIMER
                                    L'ARTICLE</a>
                            <?php
                            endif; ?>
                        </div>
                    </div>
                </div>

                <h2 id="title_comment">Commentaires</h2>
                <div class="card_articles">
                    <?php
                    foreach ($article->getComments() as $comment): ?>
                        <div id="card_accueil">
                            <div id="card_titleComment">
                                <h6 id="title_h6Comment">Ecrit le : <?= $comment->getCreatedAt()->format('d/m/y') ?>
                                    à <?= $comment->getCreatedAt()->format('H:i') ?> par
                                    : <?= $comment->getAuthor()->getFullName() ?></h6>
                            </div>
                            <div id="card_articleText">
                                <p><?= $comment->getCommentText() ?></p>
                            </div>
                            <?php
                            if (isset($_SESSION['user']) && $_SESSION['user']->getIdRight() == 42): ?>
                                <div id="card_button">
                                    <form action="article.php?id=<?= $_GET['id'] ?>" method="POST">
                                        <button class="buttonCard" name="deleteCom" type="submit">SUPPRIMER LE
                                            COMMENTAIRE
                                        </button>
                                    </form>
                                </div>
                            <?php
                            endif; ?>
                        </div>

                    <?php
                    endforeach; ?>
            </article>
            <div id="formCommentColumn">
                <?php
                if (isset($_SESSION['user'])) : ?>
                    <h6 id="titleCommentForm">BALANCE<br><span id="letterCom">TON COMM'</span></h6>
                    <form id="article" action="article.php?id=<?= $_GET['id']; ?> method='POST'">
                        <div>
                            <label for="commentaire">Commentaire</label>
                            <input type="text" name="commentaire" required placeholder="Commentaire" value="<?php
                            if (!empty($modifcom)) : echo $modifcom['commentaire'];
                            endif; ?>">
                        </div>
                        <br>
                        <div>
                            <?php
                            if (empty($modifcom)) : ?>
                                <button id="buttonSub" class="buttonCard" type="submit" name="envoyer">
                                    Envoyer
                                </button>
                            <?php
                            else : ?>
                                <button id="buttonSub" type="submit" name="majcom">
                                    Envoyer
                                </button>
                            <?php
                            endif; ?>
                        </div>

                    </form>
                <?php
                endif; ?>
                <br>
                <a href="articles.php" class="card-link">
                    <button id="button_back2" type="button" class="btn btn-light">
                        RETOUR ARTICLES
                    </button>
                </a>
                <?php
                if (isset($newcomment) && gettype($newcomment) === 'object') : ?>
                    <div class="errormessage">
                        <p><?= $newcomment->getMessage(); ?></p>
                    </div>
                <?php
                endif; ?>
            </div>
        </section>
    </main>

<?php
require_once('../config/footer.php'); ?>

<?php
$pageContent = ob_get_clean(); ?>

<?php
require_once('template.php'); ?>