<?php
require('../config/header.php');
require('../app/views/Article.php');
$nameCat = new blog\app\views\Categorie();
$articlesTable = new blog\app\views\Article();

if(isset($_GET['start']) && !empty($_GET['start'])){
    $currentPage = (int) strip_tags($_GET['start']);
}else{
    $currentPage = 1;
}
?>
<form id="selectCategorie" action="articles.php" method="POST">
    <div>
        <label for="categorie">Categories :</label>
        <select  name="categorie" required>
            <?= $nameCat->showNameCategorieForm(); ?>
        </select>
    </div>
        <button id="buttonSub" type="submit" name="filtrer">Filtrer</button>
    <?php if(isset($_POST['filtrer'])){
         $pages = $articlesTable->showArticleByCategorie($currentPage);

    } elseif(!isset($_POST['filtrer'])) {
        $pages = $articlesTable->showArticleArticles($currentPage);

    }
    ?>
</form>





