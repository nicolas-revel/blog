<?php
require('../config/header.php');
require('../app/controllers/Article.php');
$nameCat = new blog\app\views\Categorie();
$pageTitle = "Accueil";
?>

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
            $post->insertArticle(1);

        }
        ?>
</form>

