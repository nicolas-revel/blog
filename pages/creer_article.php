<?php
require_once('../app/Autoload.php');
session_start();
$nameCat = new blog\app\views\Categorie();
$show = new blog\app\views\Article();
?>
<?php $pageTitle = 'ECRIRE ARTICLE'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<main>

    <section id="pageInscription"><!-- row -->
        <div id="illusRedac">
            <img id="redac" src="../images/redaction.png" alt="illustration redactrice">
        </div>

        <div id="formIns">
            <h3 id="title_ins"><span class="bw">R</span><span class="bw">e</span><span class="bw">d</span><span class="bw">a</span><span class="bw">c</span><span class="bw">t</span><span class="bw">i</span><span class="bw">o</span><span class="bw">n</span></h3>
            <p id="slogan1">Balance les news!</p>
            <br>
            <form id="blogForm" action="creer_article.php" method="POST">
                <br>
                <div>
                    <label for="article" class="form-label">Article :<br>
                        <textarea name="article"
                                  rows="5" cols="30"
                                  minlength="10" maxlength="30">Vous pouvez écrire ici.</textarea>
                    </label>
                </div>
                <br>
                <div>
                    <label for="categorie">Categories :</label><br>
                    <select  name="categorie" required>
                        <?= $nameCat->showNameCategorieForm(); ?>
                    </select>
                </div>
                <div id="buttonCreer">
                    <button type="button" class="btn btn-outline-light" name="envoyer">Envoyer</button>
                </div>
                <?php
                if(isset($_POST['envoyer'])) {
                    $post = new blog\app\controllers\Article();
                    $post->insertArticle(2);
                }
                ?>
            </form>
        </div>
    </section>
</main>

<?php require_once('../config/footer.php'); ?>
<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
