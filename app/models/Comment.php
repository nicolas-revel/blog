<?php


namespace blog\app\models;


class Comment extends Article
{
    protected $table = "commentaires";
    /**
     * Méthode qui permet d'insérer un commentaire en base de donnée
     * @param $commentaire
     * @return void
     */
    public function insertComment ($commentaire, $id_article, $id_utilisateur, $date): void {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("INSERT INTO commentaires ($commentaire, $id_article, $id_utilisateur, $date) VALUES (:commentaire, :id_article, :id_utilisateur, :date)");
        $req->bindValue(':commentaire', $commentaire, \PDO::PARAM_STR);
        $req->bindValue(':id_article', $id_article, \PDO::PARAM_INT);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':date', $date, \PDO::PARAM_STR);
        $req->execute()or die(print_r($request->errorInfo()));

    }

    /**
     * Méthode qui permet de récupérer les commentaire d'un article
     * @param int $article_id
     * @return array
     */
    public function findAllWithArticle (int $article_id): array {

        $bdd = $this->getBdd();

        $req = $bdd->("SELECT id, commentaire, id_article, id_utilisateur, date FROM commentaires WHERE id_article = :id");
        $req->execute(['id' => $article_id]);

        $result = $req->fetchAll();

        return $result;
    }

}