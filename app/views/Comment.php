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

                $date = explode(' ', $value['date'])[0];
                $dateFr = strftime('%d-%m-%Y',strtotime($date));

                $Hour = explode(' ', $value['date'])[1];
                $HourForm = date('H:i', strtotime($Hour));

                ?>
                <div id="card_accueil">
                    <div id="card_titleComment">
                        <h6 id="title_h6Comment">Ecrit le : <?= $dateFr ?> à <?= $HourForm ?></h6>
                    </div>
                    <div id="card_articleText">
                        <p><?= $value['commentaire']; ?></p>
                    </div>
                </div>
                <?php
            }
        }

        $pagination = new \blog\app\views\Article();
        $pagination->showPagination($url = "?id=", $get = $_GET['id'], $start = "&start=", $currentPage, $pages);
    }

}