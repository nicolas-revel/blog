<?php


namespace blog\app\models;

require_once("../app/models/Article.php");

class Comment extends Article
{
    protected $table = "commentaires";

    /**
     * Méthode qui permet d'insérer un commentaire en base de donnée
     * @param $commentaire
     * @param $id_article
     * @param $id_utilisateur
     */
    public function insertCommentBd ($commentaire, $id_article, $id_utilisateur) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("INSERT INTO commentaires (commentaire, id_article, id_utilisateur, date) VALUES (:commentaire, :id_article, :id_utilisateur, NOW())");
        $req->bindValue(':commentaire', $commentaire);
        $req->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->execute()or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet de récupérer les commentaire d'un article
     * @param int $article_id
     * @return array
     */
    public function findAllWithArticle (int $article_id): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, commentaire, id_article, id_utilisateur, date FROM commentaires WHERE id_article = :id");
        $req->execute(['id' => $article_id]);

        $result = $req->fetchAll();

        return $result;
    }

}