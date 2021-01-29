<?php
require_once('../app/Autoload.php');
session_start();
$articlesTable = new \blog\app\views\Article();
$showComment = new \blog\app\views\Comment();
$com = new \blog\app\controllers\Comment();

if (isset($_GET['start']) && !empty($_GET['start'])) {
  $currentPage = (int)strip_tags($_GET['start']);
} else {
  $currentPage = 1;
}
if (isset($_GET['modifcom'])) {
  $modifcom = $com->getCommentBd($_GET['modifcom']);
}

?>
<?php $pageTitle = 'ARTICLES'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>
  <section id="info_articles">
    <h2 id="title_blogout2"><span class="bw">A</span><span class="bw">r</span><span class="bw">t</span><span class="bw">i</span><span class="bw">c</span><span class="bw">l</span><span class="bw">e</span></h2>
    <p>A vos lunettes et bonne découverte.<br>N'hésites pas à commenter
      l'article!</p>
  </section>
  <section id="showArticle">
    <article class="articlePagination">
      <div class="card_articles"><?= $articlesTable->showOneArticle(); ?></div>

      <h2 id="title_comment">Commentaires</h2>
      <div class="card_articles"><?php $pages = $showComment->showCommentWithArticle($currentPage); ?></div>
      <?php $articlesTable->showPagination($url = "?id=", $get = $_GET['id'], $start = "&start=", $currentPage, $pages); ?>
    </article>
    <div id="formCommentColumn">
      <?php if (isset($_SESSION['user'])) : ?>
        <h6 id="titleCommentForm">BALANCE<br><span id="letterCom">TON COMM'</span></h6>
        <form id="article" action="article.php?id=<?= $_GET['id']; ?><?php if (isset($_GET['modifcom'])) : echo "&modifcom={$_GET['modifcom']}";
                                                                      endif; ?>" method="POST">
          <div>
            <label for="commentaire">Commentaire</label>
            <input type="text" name="commentaire" required placeholder="Commentaire" value="<?php if (!empty($modifcom)) : echo $modifcom['commentaire'];
                                                                                            endif; ?>">
          </div>
          <br>
          <div>
            <?php if (empty($modifcom)) : ?>
              <button id="buttonSub" type="submit" name="envoyer">
                Envoyer
              </button>
            <?php else : ?>
              <button id="buttonSub" type="submit" name="majcom">
                Envoyer
              </button>
            <?php endif; ?>
          </div>
          <?php if (isset($_POST['envoyer'])) {
            $newcomment = $showComment->insertComments(
              $_GET['id'],
              $_SESSION['user']->getIdUser()
            );
          }
          if (isset($_POST['majcom']) && isset($modifcom)) {
            $com->updateComments(
              $modifcom['id'],
              $modifcom['id_article'],
              $modifcom['id_utilisateur']
            );
          }
          ?>

        </form>
      <?php endif; ?>
      <br>
      <a href="articles.php" class="card-link">
        <button id="button_back2" type="button" class="btn btn-light">
          RETOUR ARTICLES
        </button>
      </a>
      <?php if (isset($newcomment) && gettype($newcomment) === 'object') : ?>
        <div class="errormessage">
          <p><?= $newcomment->getMessage(); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php require_once('../config/footer.php'); ?>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>