<?php


namespace blog\app\views;


require('../app/controllers/Article.php');


class Article extends \blog\app\controllers\Article
{

    public function showArticleAccueil() {

        $nameCat = $this->tabCategorie();

        $articles = $this->ShowArticleDesc(0, 3);

            foreach($articles as $keyA => $values){

                $date = explode(' ', $values['date'])[0];
                $dateFr = strftime('%d-%m-%Y',strtotime($date));

                $Hour = explode(' ', $values['date'])[1];
                $HourForm = date('H:i', strtotime($Hour));

                foreach($nameCat as $key => $value) {

                if($values['id_categorie'] == $value){

                    $valuesArticle = $values['article'];
                    $valuesId = $values['id'];
                    $title = $values['titre'];

                    $this->cardArticle($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId);

                }
            }

        }

    }

    public function showArticleArticles($currentPage) {

        $nbArticles = $this->nbrArticle();
        $parPage = 5;

        // On calcule le nombre de pages total
        $pages = ceil($nbArticles / $parPage);
        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;
        $nameCat = $this->tabCategorie();
        $articles = $this->ShowArticleDesc($premier, $parPage);

            foreach($articles as $keyA => $values){

                $date = explode(' ', $values['date'])[0];
                $dateFr = strftime('%d-%m-%Y',strtotime($date));

                $Hour = explode(' ', $values['date'])[1];
                $HourForm = date('H:i', strtotime($Hour));

                foreach($nameCat as $key => $value) {

                    if($values['id_categorie'] == $value){

                        $valuesArticle = $values['article'];
                        $valuesId = $values['id'];
                        $title = $values['titre'];

                        $this->cardArticleByFive($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId);

                    }
                }

            }
        return $pages;
    }


    public function showArticleByCategorie($currentPage) {

        $nbArticles = $this->nbrArticleId(" WHERE id_categorie = :id_categorie ");
        $parPage = 4;

        // On calcule le nombre de pages total
        $pages = ceil($nbArticles / $parPage);

        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;
        $nameCat = $this->tabCategorie();
        $articles = $this->ArticleByCategorie($premier, $parPage);

            foreach($articles as $keyA => $values){

                $date = explode(' ', $values['date'])[0];
                $dateFr = strftime('%d-%m-%Y',strtotime($date));

                $Hour = explode(' ', $values['date'])[1];
                $HourForm = date('H:i', strtotime($Hour));

                foreach($nameCat as $key => $value) {

                    if($values['id_categorie'] == $value){

                        $valuesArticle = $values['article'];
                        $valuesId = $values['id'];
                        $title = $values['titre'];

                        $this->cardArticleByFive($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId);

                    }
                }
            }
            return $pages;
    }

    public function cardArticle ($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId) {
        ?>
        <div id="card_accueil3">
            <div id="title3">
                <h5 id="card_title3"><?= $title; ?></h5>
                <h6 id="title3_h6">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></h6>
            </div>
            <div id="card_articleText">
                <p><?= $valuesArticle; ?></p>
            </div>
            <div id="card_button3">
                <a class= "buttonCard" href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                <a class= "buttonCard" href="article.php?id=<?= $valuesId ?>" class="card-link">VOIR L'ARTICLE</a>
            </div>
        </div>
        <?php
    }

    public function cardArticleByFive ($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId) {
        ?>
            <div id="card_accueil">
                <div id="card_title">
                <h5><?= $title; ?></h5>
                    <span id="title_h6">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></span>
                </div>
                <div id="card_articleText">
                    <p><?= $valuesArticle; ?></p>
                </div>
                <div id="card_button">
                    <a class= "buttonCard" href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                    <a class= "buttonCard" href="article.php?id=<?= $valuesId ?>" class="card-link">VOIR L'ARTICLE</a>
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
    public function showPagination(?string $url = null, ?int $get = null, ?string $start = null, $currentPage, $pages){

        ?>
        <nav>
            <ul class="pagination">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                    <a href="<?= $url . $get ?><?= $start . ($currentPage - 1) ?>" class="page-link">Précédente</a>
                </li>
                <?php for($page = 1; $page <= $pages; $page++): ?>
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="<?= $url .  $get ?><?= $start . $page ?>" class="page-link"><?= $page ?></a>
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



    public function showOneArticle ()
    {

        if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $id_article = $_GET['id'];
            $article = $this->showArticleAlone($id_article);

            $nameCat = $this->tabCategorie();

            foreach ($nameCat as $key => $value) {

                if ($article['id_categorie'] == $value) {

                    echo $key . '<br>' . 'Article :' . $article['article'] . '<br>' . 'écrit le :' . $article['date'] . '<br>';
                }
            }
        }


    }
}


