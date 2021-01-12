<?php


namespace blog\app\controllers;


class Comment extends Article
{
    /**
     * Méthode qui permet d'insérer un commentaire par rapport à un article
     * @return bool
     */
    public function insertComments (): bool {
        //Traitement du formulaire
        //Appel de la méthode ->find(id_article)
        //Appel de la méthode ->insertComment($commentaire)
    }

    public function deleteComments () {
        //Traitement des $_GET
        //Appel de la méthode ->find(id_article) pour vérifier si l'article existe
        //Appel de la méthode ->delete($id)
    }
}