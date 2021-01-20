<?php


namespace blog\app\views;


class Article extends \blog\app\controllers\Article
{

    public function showArticleAccueil() {

        $nameCat = $this->tabCategorie();

        $articles = $this->ShowArticleDesc(0, 3);

            foreach($articles as $keyA => $values){

                foreach($nameCat as $key => $value) {

                if($values['id_categorie'] == $value){

                    echo $key.'<br>'.'Article :'.$values['article'].'<br>'.'écrit le :'.$values['date'].'<br>';
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

    public function showArticleArticles() {

        $currentPage = $this->getStart();

        $nbArticles = $this->nbrArticle();
        $parPage = 5;

        // On calcule le nombre de pages total
        $pages = ceil($nbArticles / $parPage);
        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;

        $nameCat = $this->tabCategorie();

        $articles = $this->ShowArticleDesc($premier, $parPage);

            foreach($articles as $keyA => $values){

                foreach($nameCat as $key => $value) {

                    if($value == $values['id_categorie']){?>

                        <table>
                            <thead>
                                <th>Categorie</th>
                                <th>Article</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $key; ?></td>
                                    <td><a href="article.php?id=<?= $values['id']; ?>"><?= $values['article']; ?></a></td>
                                    <td><?= $values['date']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php

                    }

                }

            }

            $this->showPagination($currentPage, $pages);
    }


    public function showArticleByCategorie() {

        $currentPage = $this->getStart();

        $nbArticles = $this->nbrArticleId(" WHERE id_categorie = :id_categorie ");

        $parPage = 4;

        // On calcule le nombre de pages total
        $pages = ceil($nbArticles / $parPage);

        // Calcul du 1er article de la page
        $premier = ($currentPage * $parPage) - $parPage;

        $nameCat = $this->tabCategorie();

        $articles = $this->ArticleByCategorie($premier, $parPage);

            foreach($articles as $keyA => $values){

                foreach($nameCat as $key => $value) {

                    if($value == $values['id_categorie']){?>

                <table>
                    <thead>
                        <th>Categorie</th>
                        <th>Article</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $key; ?></td>
                            <td><a href="article.php?id=<?= $values['id']; ?>"><?= $values['article']; ?></a></td>
                            <td><?= $values['date']; ?></td>
                        </tr>
                    </tbody>
                </table>
        <?php
                    }
                }
            }
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

    public function listArticleAdmin()
    {
        $articles = $this->createTabArticles();
        $tbody = "";
        foreach ($articles as $article) {
            $tbody = $tbody . <<<HTML
<tr>
    <td>{$article['id']}</td>
    <td>{$article['article']}</td>
    <td>{$article['nom']}</td>
    <td>{$article['login']}</td>
    <td>{$article['date']}</td>
    <td><a href="{$_SERVER['PHP_SELF']}?delArti={$article['id']}">Supprimer 
    l'article</a></td>
</tr>
HTML;
        }
        return $tbody;
    }

    public function tableArticle()
    {
        $tbody = $this->listArticleAdmin();
        $vue = <<<HTML
<h2>Liste des articles</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Article</th>
            <th>Catégorie</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Supprimer l'article</th>
        </tr>
    </thead>
    <tbody>
        {$tbody}
    </tbody>
</table>
HTML;
        echo $vue;
    }
}