<?php


namespace blog\app\views;


class Comment extends \blog\app\controllers\Comment
{
    /**
     * Méthode qui permet d'afficher les commentaires d'un article par rapport à son id
     * @param $currentPage
     * @return false|float
     */
    public function showCommentWithArticle($currentPage) {

        if(isset($_GET['id']) && ctype_digit($_GET['id'])) {

            $article_id = $_GET['id'];

            $nbComment = $this->nbrCommentId();

            $parPage = 5;

            $pages = ceil($nbComment / $parPage);
            // Calcul du 1er article de la page
            $premier = ($currentPage * $parPage) - $parPage;

            $comment = $this->showComments($article_id, $premier, $parPage);

            foreach($comment as $key => $value){

                echo '<br>' . 'Commentaire :' . $value['commentaire'] . '<br>' . 'écrit le :' . $value['date'] . '<br>';

            }
        }
        return $pages;
    }

}