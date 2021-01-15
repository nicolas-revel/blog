<?php


namespace blog\app\views;

require('../app/controllers/Article.php');


class Article extends \blog\app\controllers\Article
{
    public function showArticleAccueil() {

        $nameCat = $this->tabCategorie();

        $articles = $this->ArticleAccueil();

        foreach($nameCat as $key => $value) {

            foreach($articles as $keyA => $values){

                if($values['id_categorie'] == $value){

                    echo $key.'<br>'.'Article :'.$values['article'].'<br>'.'écrit le :'.$values['date'].'<br>';
                }
            }

        }
    }
}