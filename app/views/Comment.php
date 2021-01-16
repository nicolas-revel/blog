<?php


namespace blog\app\views;

require('../app/controllers/Comment.php');

class Comment extends \blog\app\controllers\Comment
{
    public function insertCommmentByArticle($id_utilisateur) {

        if(isset($_GET['id']) && ctype_digit($_GET['id'])) {
            $id_article = $_GET['id'];
            $this->insertComments($id_article, $id_utilisateur);
        }


    }
}