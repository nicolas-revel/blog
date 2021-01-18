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
    public function findAllWithArticle (int $article_id, $premier, $parPage): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, commentaire, id_article, id_utilisateur, date FROM commentaires WHERE id_article = :id ORDER BY date DESC LIMIT :premier, :parpage ");
        $req->bindValue(':id', $article_id, \PDO::PARAM_INT);
        $req->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetchAll();

        return $result;
    }

    public function countCommentById ($article_id) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('SELECT COUNT(*) AS nb_comment FROM commentaires WHERE id_article = :id_article');
        $req->bindValue(':id_article', $article_id, \PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();

        return $result;

    }

}