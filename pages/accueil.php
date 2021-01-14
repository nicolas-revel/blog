<?php
require('../config/header.php');
require('../app/views/Article.php');
$nameCat = new blog\app\views\Categorie();
$show = new blog\app\views\Article();
$pageTitle = "Accueil";
?>

<div><?= $show->showArticleAccueil(); ?></div>

