<?php


namespace blog\app\controllers;

use blog\app\ErrorMessage;

require_once('../app/Http.php');

class Comment extends \blog\app\models\Comment
{

    /**
     * Méthode qui permet d'insérer un commentaire par rapport à un article
     * @param $id_article
     * @param $id_utilisateur
     */
    public function insertComments($id_article, $id_utilisateur)
    {

        if (!empty($_POST['commentaire'])) {

            $commentaire = htmlspecialchars($_POST['commentaire']);

        } else {
            return new ErrorMessage('Merci de bien remplir le formulaire');
        }

        //Expression régulière afin de limiter le nombre de caractères, max 1024
        $checkComm = preg_match("/^(?!\s*$)[-a-zA-Z0-9_:,.\s]{1,1024}$/", $commentaire);
        if (!$checkComm) {
            return new ErrorMessage('Votre commentaire doit faire moins de 1024 caractères');
        }

        $this->insertCommentBd($commentaire, $id_article, $id_utilisateur);

        \blog\app\Http::redirect("article.php?id=$id_article");

    }

    public function updateComments(int $id, int $article_id, int $id_utilisateur)
    {

        if (!empty($_POST['commentaire'])) {

            $commentaire = htmlspecialchars($_POST['commentaire']);

        } else {
            die("Votre formulaire à été mal rempli");
        }

        $this->updateArticleBd($id, $commentaire, $article_id, $id_utilisateur);

        //\Http::redirect("article.php?id=$article_id");

    }

    public function deleteComments($id)
    {
        $this->deleteCommentDb($id);
    }

    public function showComments($id_article, $premier, $parPage)
    {

        $comment = $this->selectCommentWithArticle($premier, $parPage, $id_article);

        return $comment;
    }

    public function nbrCommentId()
    {

        if (!empty($_GET['id'])) {

            $article_id = $_GET['id'];

            $comment = $this->countCommentById($article_id);
            $nbComment = (int)$comment['nb_comment'];
        }

        return $nbComment;
    }

    public function creaTableComment()
    {
        return $this->getAllCommentDb();
    }

    public function getComment($id)
    {
        $this->getCommentBd($id);
    }
}