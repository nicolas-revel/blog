<?php


namespace blog\app\controllers;

require_once("../app/models/Comment.php");
require_once("../app/Http.php");

class Comment extends \blog\app\models\Comment
{

    /**
     * Méthode qui permet d'insérer un commentaire par rapport à un article
     * @param $id_article
     * @param $id_utilisateur
     */
    public function insertComments($id_article, $id_utilisateur) {

        if(!empty($_POST['commentaire'])){

            $commentaire = htmlspecialchars($_POST['commentaire']);

        }else {
            die("Votre formulaire à été mal rempli");
        }

            $this->insertCommentBd($commentaire, $id_article, $id_utilisateur);

            \Http::redirect("article.php?id=$id_article");

    }

    public function updateComments(int $id, int $article_id, int $id_utilisateur) {

        if(!empty($_POST['commentaire'])){

            $commentaire = htmlspecialchars($_POST['commentaire']);

        }else {
            die("Votre formulaire à été mal rempli");
        }

        $this->updateArticleBd ($id, $commentaire, $article_id, $id_utilisateur);

        \Http::redirect("article.php?id=$article_id");

    }

    public function deleteComments () {
        //Traitement des $_GET
        //Appel de la méthode ->find(id_article) pour vérifier si l'article existe
        //Appel de la méthode ->delete($id)
    }

    public function showComments($id_article, $premier, $parPage) {

        $comment = $this->findAllWithArticle($id_article, $premier, $parPage);

        return $comment;
    }

    public function nbrCommentId () {

        if(!empty($_GET['id'])){

            $article_id = $_GET['id'];

            $comment = $this->countCommentById($article_id);
            $nbComment = (int)$comment['nb_comment'];
        }

        return $nbComment;
    }
}