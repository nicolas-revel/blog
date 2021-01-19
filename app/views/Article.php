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

                if($values['id_categorie'] == $value){ ?>

                <div id="row_article">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Title Article</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></h6>
                                    <p class="card-text"><?= $values['article']; ?></p>
                                <a href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                                <a href="article.php?id=<?= $values['id'] ?>" class="card-link">VOIR L'ARTICLE</a>
                        </div>
                    </div>
                </div>
                    <?php
                }
            }

        }

    }

    public function getStart (){
        if(isset($_GET['start']) && !empty($_GET['start'])){
            $currentPage = (int) strip_tags($_GET['start']);
        }else{
            $currentPage = 1;
        }
        return $currentPage;
    }

    public function showArticleArticles($currentPage) {

        $nbArticles = $this->nbrArticle();
        $parPage = 4;

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

                    if($values['id_categorie'] == $value){ ?>

                    <div id="row_article">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Title Article</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></h6>
                                <p class="card-text"><?= $values['article']; ?></p>
                                <a href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                                <a href="article.php?id=<?= $values['id'] ?>" class="card-link">VOIR L'ARTICLE</a>
                            </div>
                        </div>
                    </div>
                        <?php
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

                    if($values['id_categorie'] == $value){ ?>

                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Title Article</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></h6>
                                <p class="card-text"><?= $values['article']; ?></p>
                                <a href="articles.php?categorie=<?= $value ?>" class="card-link"><?= $key; ?></a>
                                <a href="article.php?id=<?= $values['id'] ?>" class="card-link">VOIR L'ARTICLE</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
        return $pages;
    }

    public function showPagination($currentPage, $pages){

        ?>
            <nav>
                <ul class="pagination">
                <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                    <a href="?start=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                </li>
                <?php for($page = 1; $page <= $pages; $page++): ?>
                    <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="?start=<?= $page ?>" class="page-link"><?= $page ?></a>
                 </li>
                <?php endfor ?>
                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                    <a href="?start=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                </li>
                </ul>
            </nav>
        <?php
    }

    public function showPaginationWithCategorie($currentPage, $pages){

        if(isset($_GET['categorie']) && !empty($_GET['categorie'])){ ?>

            <nav>
                <ul class="pagination">
                    <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a href="?categorie=<?=$_GET['categorie'] ?>&start=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                    </li>
                    <?php for($page = 1; $page <= $pages; $page++): ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                            <a href="?categorie=<?=$_GET['categorie'] ?>&start=<?= $page ?>" class="page-link"><?= $page ?></a>
                        </li>
                    <?php endfor ?>
                    <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a href="?categorie=<?=$_GET['categorie'] ?>&start=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                    </li>
                </ul>
            </nav>
            <?php
        }
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


