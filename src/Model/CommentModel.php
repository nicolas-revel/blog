<?php


namespace App\Model;

use app\models\Model;

class CommentModel extends model
{
    protected $table = "commentaires";
    protected $where = "id_article";
    protected $resultWhere = ":id";

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
     * Méthode qui permet de modifier un commentaire par rapport à son id
     * @param int $id
     * @param string $commentaire
     * @param int $article_id
     * @param int $id_utilisateur
     */
    public function updateArticleBd (int $id, string $commentaire, int $article_id, int $id_utilisateur) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('UPDATE commentaires SET commentaire = :commentaire, id_article = :id_article, id_utilisateur = :id_utilisateur, date = NOW() WHERE id = :id');
        $req->bindValue(':commentaire', $commentaire);
        $req->bindValue(':id_article', $article_id, \PDO::PARAM_INT);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute()or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet de compter le nombre de commentaires par rapport à l'id de l'article
     * @param int $article_id
     * @return mixed
     */
    public function countCommentById (int $article_id) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('SELECT COUNT(*) AS nb_comment FROM commentaires WHERE id_article = :id_article');
        $req->bindValue(':id_article', $article_id, \PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();

        return $result;

    }

    public function getAllCommentDb()
    {
        $bdd = $this->getBdd();
        $sql = 'SELECT commentaires.id, commentaire, id_article, commentaires.id_utilisateur, commentaires.date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id = id_utilisateur INNER JOIN articles ON articles.id = id_article ORDER BY commentaires.id ASC';
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;

    }

    public function getCommentBd($id)
    {
        $bdd = $this->getBdd();
        $sql = "SELECT id, commentaire, id_article, id_utilisateur, date FROM commentaires WHERE id = {$id}";
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result[0];
    }

    public function deleteCommentDb($id) {
        $this->deleteBd($id);
    }

    /**
     * Permet de récupérer tous les articles ou tout les commentaires dans l'ordre décroissant par rapport l'id de la catégorie
     * @param int $premier
     * @param int $parPage
     * @param int $id_categorie
     * @return array
     */
    public function selectCommentWithArticle(int $premier, int $parPage, int $id_categorie)
    {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT commentaires.id, commentaire, id_article, commentaires.id_utilisateur, commentaires.date, utilisateurs.login FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id = id_utilisateur INNER JOIN articles ON articles.id = id_article WHERE id_article = :id ORDER BY date DESC LIMIT :premier, :parpage ");
        $req->bindValue( ":id", $id_categorie, \PDO::PARAM_INT);
        $req->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

}