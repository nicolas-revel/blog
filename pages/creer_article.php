<?php
require_once('../app/Autoload.php');
session_start();
$nameCat = new blog\app\views\Categorie();
$show = new blog\app\views\Article();
?>
<?php $pageTitle = 'THE FACTORY'; ?>
<?php ob_start(); ?>
<?php require_once('../config/header.php'); ?>

<h1>FORMULAIRE ARTICLE</h1>
<form id="insertArticle" action="accueil.php" method="POST">
    <br>
    <div>
        <label for="article" class="form-label">Article :</label>
        <input type="text" class="form-control" name="article" required>
    </div>
    <br>
    <div>
        <label for="categorie">Categories :</label>
        <select  name="categorie" required>
            <?= $nameCat->showNameCategorieForm(); ?>
        </select>
    </div>
    <br>
    <div class="col-12">
        <button id="buttonSub" type="submit" name="envoyer">Envoyer</button>
    </div>
    <?php
    if(isset($_POST['envoyer'])) {
        $post = new blog\app\controllers\Article();
        $post->insertArticle(2);
    }
    ?>
</form>

<?php $pageContent = ob_get_clean(); ?>

<?php require_once('template.php'); ?>
