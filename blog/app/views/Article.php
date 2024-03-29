<?php


namespace blog\app\views;


class Article extends \blog\app\controllers\Article
{
    /**
     * Méthode qui permet d'afficher sur la page accueil les 3 derniers articles
     */
    public function showArticleAccueil()
    {

        $nameCat = $this->tabCategorie();
        $articles = $this->selectPages(0, 3);

        foreach ($articles as $keyA => $values) {

                foreach ($nameCat as $key => $value) {

                        if ($values['id_categorie'] == $value) {

                            $valuesLogin = $values['login'];
                            $valuesArticle = $values['article'];
                            $valuesId = $values['id'];
                            $title = $values['titre'];
                            $valueDate = $values['date'];

                            $dateFormat = $this->getFormatDate($valueDate);
                            $this->cardArticle($title, $dateFormat, $valuesLogin, $valuesArticle, $value, $key, $valuesId);
                        }

                    }
                }

    }

    /**
     * Méthode afin de formater la date et l'heure au format d-m-Y
     * @param $valueDate
     * @return string
     */
    public function getFormatDate ($valueDate){

        $date = explode(' ', $valueDate)[0];
        $dateFr = strftime('%d-%m-%Y', strtotime($date));

        $Hour = explode(' ', $valueDate)[1];
        $HourForm = date('H:i', strtotime($Hour));

        return $dateFr . ' à ' . $HourForm;
    }

    /**
     * Méthode qui permet d'afficher sur la pages Articles, tout articles confondus 5 par 5 grâce a une pagination
     * @param $currentPage
     */
    public function showArticleArticles($currentPage)
    {

        $nbArticles = $this->nbrArticle();
        $parPage = 5;

        // On calcule le nombre de pages total
        $pages = ceil($nbArticles / $parPage);
        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;
        $nameCat = $this->tabCategorie();
        $articles = $this->selectPages($premier, $parPage);

        foreach ($articles as $keyA => $values) {

                foreach ($nameCat as $key => $value) {

                        if ($values['id_categorie'] == $value) {

                            $valuesLogin = $values['login'];
                            $valuesArticle = $values['article'];
                            $valuesId = $values['id'];
                            $title = $values['titre'];
                            $valueDate = $values['date'];

                            $dateFormat = $this->getFormatDate($valueDate);
                            $this->cardArticleByFive($title, $dateFormat, $valuesLogin, $valuesArticle, $value, $key, $valuesId);



                        }
                }

        }
        return $pages;
    }

    /**
     * Méthode qui permet d'afficher tout les articles d'une categorie, 5 par 5 avec une pagination
     * @param $currentPage
     */
        public function showArticleByCategorie($currentPage) {

            if(isset($_GET['categorie']) && !empty($_GET['categorie'])){

            $nbArticles = $this->nbrArticleId(" WHERE id_categorie = :id_categorie ");
            $parPage = 4;

            // On calcule le nombre de pages total
            $pages = ceil($nbArticles / $parPage);

            // Calcul du 1er article de la page
            $premier = ($currentPage * $parPage) - $parPage;
            $nameCat = $this->tabCategorie();
            $articles = $this->selectArticleByCategorie($_GET['categorie'], $premier, $parPage);

            foreach($articles as $keyA => $values){

                    foreach($nameCat as $key => $value) {

                        if ($values['id_categorie'] == $value) {

                                $valuesLogin = $values['login'];
                                $valuesArticle = $values['article'];
                                $valuesId = $values['id'];
                                $title = $values['titre'];
                                $valueDate = $values['date'];

                                $dateFormat = $this->getFormatDate($valueDate);
                                $this->cardArticleByFive($title, $dateFormat, $valuesLogin, $valuesArticle, $value, $key, $valuesId);


                        }
                    }
            }
                $this->showPagination($url = "?categorie=", $get = $_GET['categorie'], $start = "&start=", $currentPage, $pages);
            }

        }

    /**
     * Card affichage des articles sur la page Accueil
     * @param $title
     * @param $valuesArticle
     * @param $value
     * @param $key
     * @param $valuesId
     * @param $valueDate
     * @param $nameLogin
     */
        public function cardArticle ($title, $valueDate, $nameLogin, $valuesArticle, $value, $key, $valuesId) {
        ?>
        <div id="card_accueil3">
            <div id="title3">
                <h5 id="card_title3"><i id="i_title" class="fas fa-project-diagram"></i><?= $title; ?></h5>
                <h6 id="title3_h6">Ecrit le : <?= $valueDate ?> par : <?= $nameLogin ?></h6>
            </div>
            <div id="card_articleTextAccueil">
                <p><?= $valuesArticle; ?></p>
            </div>
            <div id="card_button3">
                <a class="buttonCard" href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                <a class="buttonCard" href="article.php?id=<?= $valuesId ?>" class="card-link">VOIR L'ARTICLE</a>
            </div>
        </div>
        <?php
    }

    /**
     * Card affichage articles sur la page articles
     * @param $title
     * @param $valuesArticle
     * @param $value
     * @param $key
     * @param $valuesId
     * @param $valueDate
     * @param $nameLogin
     */
    public function cardArticleByFive($title, $valueDate, $nameLogin, $valuesArticle, $value, $key, $valuesId)
    {
        ?>
        <div id="card_accueil">
            <div id="card_title">
                <h5><i id="i_title" class="fas fa-project-diagram"></i><?= $title; ?></h5>
                <span id="title_h6">Ecrit le : <?= $valueDate ?> par : <?= $nameLogin ?></span>
            </div>
            <div id="card_articleText">
                <p><?= $valuesArticle; ?></p>
            </div>
            <div id="card_button">
                <a class="buttonCard" href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                <a class="buttonCard" href="article.php?id=<?= $valuesId ?>" class="card-link">VOIR L'ARTICLE</a>
        <?php if(isset($_SESSION['user']) && $_SESSION['user']->getDroits() == 42): ?>
                <a class="buttonCard" href="creer_article.php?modifart=<?= $valuesId ?>" class="card-link">MODIFIER L'ARTICLE</a>
                <a class="buttonCard" href="articles.php?deleart=<?= $valuesId ?>" class="card-link">SUPPRIMER L'ARTICLE</a>
        <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /**
     * Card affichage article sur la page article + les commentaitres
     * @param $title
     * @param $dateFormat
     * @param $valuesArticle
     * @param $value
     * @param $key
     * @param $valueId
     * @param $nameLogin
     */
    public function cardOneArticle($title, $dateFormat, $nameLogin, $valuesArticle, $value, $key, $valueId) {

        ?>
        <div id="card_accueil">
            <div id="card_title">
                <h5><i id="i_title" class="fas fa-project-diagram"></i><?= $title; ?></h5>
                <span id="title_h6">Ecrit le : <?= $dateFormat ?> par : <?= $nameLogin ?></span>
            </div>
            <div id="card_articleText">
                <p><?= $valuesArticle; ?></p>
            </div>
            <div id="card_button">
                <a class="buttonCard" href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                <?php if(isset($_SESSION['user']) && $_SESSION['user']->getDroits() == 42): ?>
                    <a class="buttonCard" href="creer_article.php?modifart=<?= $valueId ?>" class="card-link">MODIFIER L'ARTICLE</a>
                    <a class="buttonCard" href="articles.php?deleart=<?= $valueId ?>" class="card-link">SUPPRIMER L'ARTICLE</a>
                <?php endif; ?>
            </div>
        </div>
        <?php

    }

    /**
     * Méthode qui permet de générer la pagination selon l'url, Méthode commune dans les views Article et Comment
     * @param string|null $url
     * @param int|null $get
     * @param string|null $start
     * @param $currentPage
     * @param $pages
     */
    public function showPagination(?string $url = null, ?int $get = null, ?string $start = null, $currentPage, $pages)
    {

        ?>
        <nav>
            <ul class="pagination">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                    <a href="<?= $url . $get ?><?= $start . ($currentPage - 1) ?>" class="page-link">Précédente</a>
                </li>
                <?php for ($page = 1; $page <= $pages; $page++): ?>
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="<?= $url . $get ?><?= $start . $page ?>" class="page-link"><?= $page ?></a>
                    </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                    <a href="<?= $url . $get ?><?= $start . ($currentPage + 1) ?>" class="page-link">Suivante</a>
                </li>
            </ul>
        </nav>
        <?php
    }


    /**
     * Méthode pour afficher un article en particulier
     */
    public function showOneArticle()
    {

        if (isset($_GET['id']) && ctype_digit($_GET['id'])) {

            $id_article = $_GET['id'];
            $article = $this->findbd($id_article);
            $nameCat = $this->tabCategorie();

                foreach ($nameCat as $key => $value) {

                    if ($article['id_categorie'] == $value) {

                        $valuesLogin = $article['login'];
                        $valuesArticle = $article['article'];
                        $valuesId = $article['id'];
                        $title = $article['titre'];
                        $valueDate = $article['date'];

                        $dateFormat = $this->getFormatDate($valueDate);
                        $this->cardOneArticle($title, $dateFormat, $valuesLogin, $valuesArticle, $value, $key, $valuesId);


                    }
                }

        }

    }

    public function listArticleAdmin()
    {
        $articles = $this->createTabArticles();
        $tbody = "";
        foreach ($articles as $article) {
            $tbody = $tbody . <<<HTML
<tr>
    <td>{$article['id']}</td>
    <td>{$article['titre']}</td>
    <td>{$article['article']}</td>
    <td>{$article['nom']}</td>
    <td>{$article['login']}</td>
    <td>{$article['date']}</td>
    <td><a href="{$_SERVER['PHP_SELF']}?delArti={$article['id']}">Supprimer 
    l'article</a></td>
    <td><a href="creer_article.php?modifart={$article['id']}">Modifier</a></td>
</tr>
HTML;
        }
        return $tbody;
    }

    public function tableArticle()
    {
        $tbody = $this->listArticleAdmin();
        $vue = <<<HTML
<div class="tableAdmin">
<br>
<h2 id="title_table">Liste des articles</h2>
<br>
<table id="table_ad">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Article</th>
            <th>Catégorie</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Supprimer l'article</th>
            <th>Modifier l'article</th>
        </tr>
    </thead>
    <tbody id="table_body">
        {$tbody}
    </tbody>
</table>
</div>
HTML;
        echo $vue;
    }
}