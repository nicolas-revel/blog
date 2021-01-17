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

    public function deleteComments () {
        //Traitement des $_GET
        //Appel de la méthode ->find(id_article) pour vérifier si l'article existe
        //Appel de la méthode ->delete($id)
    }

    public function showComments($id_article) {

        $comment = $this->findAllWithArticle($id_article);

        return $comment;
    }
}