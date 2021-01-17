<?php


namespace blog\app\views;

require('../app/controllers/Comment.php');

class Comment extends \blog\app\controllers\Comment
{
    public function showCommentWithArticle() {

        if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $id_article = $_GET['id'];
            $comment = $this->showComments($id_article);

            foreach($comment as $key => $value){

                echo '<br>' . 'Commentaire :' . $value['commentaire'] . '<br>' . 'écrit le :' . $value['date'] . '<br>';
            }

        }
    }
}