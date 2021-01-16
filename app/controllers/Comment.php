<?php


namespace blog\app\controllers;

require_once("../app/models/Comment.php");

class Comment extends \blog\app\models\Comment
{
    /**
     * Méthode qui permet d'insérer un commentaire par rapport à un article
     */
    public function insertComments($id_article, $id_utilisateur) {

        if(!empty($_POST['commentaire'])){

            $commentaire = htmlspecialchars($_POST['commentaire']);

        }else {
            die("Votre formulaire à été mal rempli");
        }

        /*if(isset($_GET['id']) && ctype_digit($_GET['id'])) {

            $id_article = $_GET['id'];*/

            $this->insertCommentBd($commentaire, $id_article, $id_utilisateur);


    }

    public function deleteComments () {
        //Traitement des $_GET
        //Appel de la méthode ->find(id_article) pour vérifier si l'article existe
        //Appel de la méthode ->delete($id)
    }
}