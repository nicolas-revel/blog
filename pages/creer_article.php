<?php
require_once('../app/Autoload.php');
session_start();
$nameCat = new blog\app\views\Categorie();
$show = new blog\app\views\Article();
$art = new \blog\app\controllers\Article();
if (isset($_GET['modifart'])) {
    $modifart = $art->findBd($_GET['modifart']);
    var_dump($modifart);
}
?>
<?php $pageTitle = 'THE FACTORY'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<h1>FORMULAIRE ARTICLE</h1>
<form id="insertArticle" action="creer_article.php<?php if (isset($modifart)) :
echo "?modifart={$_GET['modifart']}"; endif;?>" method="POST">
    <br>
    <div>
        <label for="article" class="form-label">Article :</label>
        <input type="text" class="form-control" name="article" value="<?php
        if (isset($modifart)) : echo "{$modifart['article']}"; endif; ?>"
               required>
    </div>
    <br>
    <div>
        <label for="categorie">Categories :</label>
        <select name="categorie" required>
            <?= $nameCat->showNameCategorieForm(); ?>
        </select>
    </div>
    <br>
    <div class="col-12">
        <?php if (isset($modifart)) : ?>
            <button id="buttonSub" type="submit" name="majart">Envoyer</button>
        <?php else: ?>
            <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
        <?php endif; ?>
    </div>
    <?php
    if (isset($_POST['envoyer'])) {
        $post = new blog\app\controllers\Article();
        $post->insertArticle(2);
    }
    if (isset($_POST['majart'])) {
        $art->updateArticle($modifart['id'], $modifart['id_utilisateur']);
    }
    ?>
</form>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
