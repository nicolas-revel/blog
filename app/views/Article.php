<?php


namespace blog\app\views;

require('../app/controllers/Article.php');


class Article extends \blog\app\controllers\Article
{
    public function showArticleAccueil() {

        $nameCat = $this->tabCategorie();

        $articles = $this->ArticleAccueil(3);

            foreach($articles as $keyA => $values){

                foreach($nameCat as $key => $value) {

                if($values['id_categorie'] == $value){

                    echo $key.'<br>'.'Article :'.$values['article'].'<br>'.'écrit le :'.$values['date'].'<br>';
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

        $articles = $this->paginationArticles($premier, $parPage);

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
                                <td><?= $values['article']; ?></td>
                                <td><?= $values['date']; ?></td>
                            </tr>
                    </tbody>
                </table>
                   <?php

                }

            }

            }

            return $pages;









    }


}