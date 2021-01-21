<?php
require_once('../app/Autoload.php');
$articlesTable = new blog\app\views\Article();
$showComment = new blog\app\views\Comment();

if(isset($_GET['start']) && !empty($_GET['start'])){
    $currentPage = (int) strip_tags($_GET['start']);
}else{
    $currentPage = 1;
}
?>
<?php $pageTitle = 'ARTICLE'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>
    <section id="info_articles">
        <h2 id="title_blogout2"><span class="bw">A</span><span class="bw">r</span><span class="bw">t</span><span class="bw">i</span><span class="bw">c</span><span class="bw">l</span><span class="bw">e</span></h2>
        <p>A vos lunettes et bonne découverte.<br>N'hésites pas à commenter l'article!</p>
    </section>

    <section id="showArticle">
        <article class="articlePagination">
            <div class="card_articles"><?= $articlesTable->showOneArticle(); ?></div>

<h2 id="title_comment">Commentaires</h2>
            <div class="card_articles"><?php $pages = $showComment->showCommentWithArticle($currentPage); ?></div>
        </article>

        <div id="formCommentColumn">
            <h6 id="titleCommentForm">BALANCE<br><span id="letterCom">TON COMM'</span></h6>

<form id="article" action="article.php?id=<?= $_GET['id']; ?>" method="POST">
    <div>
        <input type="text" name="commentaire" required placeholder="Balance ton comm'">
    </div>
    <div id="buttonSubmit">
        <button class="buttonCard" type="submit" name="envoyer">Envoyer</button>
    </div>
    <?php if(isset($_POST['envoyer'])){
        $showComment->insertComments($_GET['id'], 1);
    }
    ?>
</form>
            <a href="articles.php" class="card-link"><button id="button_back2" type="button" class="btn btn-light">RETOUR ARTICLES</button></a>
        </div>
    </section>
</main>

<?php require_once('../config/footer.php'); ?>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>

