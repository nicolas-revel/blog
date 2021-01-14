<?php


namespace blog\app\views;


class Article
{
<<<<<<< Updated upstream
=======
    public function showArticleAccueil() {

        $nameCat = $this->tabCategorie();

        $articles = $this->ArticleAccueil();

            foreach($articles as $keyA => $values){

                foreach($nameCat as $key => $value) {

                if($values['id_categorie'] == $value){

                    echo $key.'<br>'.'Article :'.$values['article'].'<br>'.'écrit le :'.$values['date'].'<br>';
                }
            }
>>>>>>> Stashed changes

}