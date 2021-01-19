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

                    $this->cardArticle ($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId);

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

                        $this->cardArticle ($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId);

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

                        $this->cardArticle ($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId);

                    }
                }
            }
            return $pages;
    }

    public function cardArticle ($title, $dateFr, $HourForm, $valuesArticle, $value, $key, $valuesId) {
        ?>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?= $title; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></h6>
                    <p class="card-text"><?= $valuesArticle; ?></p>
                    <a href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                    <a href="article.php?id=<?= $valuesId ?>" class="card-link">VOIR L'ARTICLE</a>
                </div>
            </div>
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


