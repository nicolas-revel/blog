<?php
require('../config/header.php');
//require('../app/views/Article.php');
require_once('../app/Autoload.php');
$nameCat = new blog\app\views\Categorie();
$articlesTable = new blog\app\views\Article();
?>
    <div>
        <h3>Filtrer par categorie:</h3>
            <?= $nameCat->showFiltre(); ?>
    </div>
<br>
<?php if(isset($_GET['categorie'])){
    $pages = $articlesTable->showArticleByCategorie();

} elseif(!isset($_GET['categorie'])) {
    $pages = $articlesTable->showArticleArticles();

}
?>





