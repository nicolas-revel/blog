<?php
require_once('../app/Autoload.php');
session_start();
$nameCat = new blog\app\views\Categorie();
$show = new blog\app\views\Article();
$art = new \blog\app\controllers\Article();

if (isset($_GET['modifart'])) {
    $modifart = $art->findBd($_GET['modifart']);
}
?>
<?php $pageTitle = 'ECRIRE ARTICLE'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>
    <section id="pageInscription"><!-- row -->
        <div id="illusRedac">
            <img id="redac" src="../images/redaction.png"
                 alt="illustration redactrice">
        </div>

        <div id="formCreer">
            <h3 id="title_ins"><span class="bw">R</span><span
                        class="bw">e</span><span class="bw">d</span><span
                        class="bw">a</span><span class="bw">c</span><span
                        class="bw">t</span><span class="bw">i</span><span
                        class="bw">o</span><span class="bw">n</span></h3>
            <p id="slogan1">Balance les news!</p>
            <br>
            <form id="blogForm"
                  action="creer_article.php<?php if (isset($modifart)) :
                      echo "?modifart={$_GET['modifart']}"; endif; ?>"
                  method="POST">
                <br>
                <div>
                    <label for="titre" class="form-label">Titre de
                        l'article :</label><br>
                    <input type="text" id="titre" name="titre" value="<?php
                    if (isset($modifart)) : echo "{$modifart['titre']}"; endif;
                    ?>">
                </div>
                <br>
                <div>
                    <label for="article" class="form-label">Article
                        :</label><br>
                    <textarea name="article"
                              rows="5" cols="30"
                              placeholder="Votre texte ici ..."><?php
                        if (isset($modifart)) : echo "{$modifart['article']}"; endif; ?></textarea>
                </div>
                <br>
                <div>
                    <label for="categorie">Categories :</label><br>
                    <select name="categorie" required>
                        <?= $nameCat->showNameCategorieForm(); ?>
                    </select>
                </div>
                <div id="buttonCreer">
                    <?php if (isset($modifart)) : ?>
                        <button id="buttonSub" type="submit" class="btn
                        btn-outline-light" name="majart">Envoyer
                        </button>
                    <?php else: ?>
                        <button id="buttonSub" type="submit" class="btn
                        btn-outline-light" name="envoyer">Envoyer
                        </button>
                    <?php endif; ?>
                </div>
                <?php
                if (isset($_POST['envoyer'])) {
                    $post = new blog\app\controllers\Article();
                    $newpost = $post->insertArticle($_SESSION['user']->getIdUser
                    ());
                } elseif(isset($_POST['majart'])) {
                    $post = new blog\app\controllers\Article();
                    $post->updateArticle($modifart['id'], $_SESSION['user']->getIdUser());
                    \blog\app\Http::redirect('articles.php');
                }
                ?>
                <?php if (isset($newpost) && gettype($newpost) === 'object')
                    : ?>
                    <div class="errormessage">
                        <p><?= $newpost->getMessage(); ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </section>
</main>

<?php require_once('../config/footer.php'); ?>
<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
