<?php


namespace blog\app\controllers;


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

        //Expression régulière afin de limiter le nombre de caractères, max 1024
        if(!preg_match("/^[a-zA-Z0-9_:-]{1,1024}$/", $commentaire)) {

            die("Le commentaire doit contenir 1024 caractères maximum");
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

        $comment = $this->selectArticleWithCategorie($premier, $parPage, $id_article);

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