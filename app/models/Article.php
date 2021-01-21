<?php

namespace blog\app\models;

/**
 * Class Article
 * @package blog\app\models
 */

class Article extends Model
{
    protected $table = "articles";
    protected $where = "id_categorie";
    protected $resultWhere = ":id_categorie";

    private $id;
    public $article;
    public $id_categorie;
    public $date;

    /**
     * @param string $article
     * @param int $id_utilisateur
     * @param int $id_categorie
     */
    public function insertArticleDb(string $article, int $id_utilisateur, int $id_categorie)
    {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("INSERT INTO articles (article, id_utilisateur, id_categorie, date) VALUES (:article, :id_utilisateur, :id_categorie, NOW())");
        $req->bindValue(':article', $article);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->execute() or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet de modifier un article dans la base de donnée
     * @param int $id
     * @param string $article
     * @param int $id_utilisateur
     * @param int $id_categorie
     */
    public function updateArticleBd(int $id, string $article, int $id_utilisateur, int $id_categorie)
    {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('UPDATE articles SET article = :article, id_utilisateur = :id_utilisateur, id_categorie = :id_categorie, date = NOW() WHERE id = :id');
        $req->bindValue(':article', $article);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute() or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet de récupérer toute les informations et qui seront "stockées" dans les attributs
     * @param int $id_utilisateur
     * @return array
     */
    public function findArticleBd(int $id_utilisateur): array
    {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, article, id_utilisateur, id_categorie, date FROM articles WHERE id = :id");
        $req->execute(['id' => $id_utilisateur]);
        $result = $req->fetch(\PDO::FETCH_OBJ);

        $this->id = $result->id;
        $this->article = $result->article;
        $this->id_utilisateur = $result->id_utilisateur;
        $this->id_categorie = $result->id_categorie;
        $this->date = $result->date;

    }

    /**
     * Méthode qui permet de récupérer un article par rapport à l'id de l'article
     * @param int $id
     * @return array
     */
    public function findBd(int $id_article): array
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, titre, article, id_utilisateur, id_categorie, date FROM articles WHERE id = :id");
        $req->execute(['id' => $id_article]);

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Méthode qui permet de récupérer les 5 premiers articles dans l'ordre decroissant
     * @param int $premier
     * @param int $parPage
     * @return array
     */
    public function selectPages(int $premier, int $parPage): array
    {
        $bdd = $this->getBdd();

        $req = $bdd->prepare('SELECT * FROM articles ORDER BY date DESC LIMIT :premier, :parpage');
        $req->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();
        $articles = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $articles;
    }

    /**
     * Méthode qui permet de compter le nombre d'article en général ou par rapport l'id de la catégorie
     * @param string|null $withCategorie
     * @param int|null $id_categorie
     * @return mixed
     */
    public function countArticle(?string $withCategorie = "", ?int $id_categorie)
    {
        $bdd = $this->getBdd();
        $sql = "SELECT COUNT(*) AS nb_articles FROM articles";

        if ($withCategorie) {

            $sql .= $withCategorie;
            $req = $bdd->prepare($sql);
            $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
            $req->execute();
            $result = $req->fetch();

        } else {

            $sql;
            $req = $bdd->prepare($sql);
            $req->execute();
            $result = $req->fetch();
        }

        return $result;

    }

    public function getArticlesAuthors()
    {
        $bdd = $this->getBdd();
        $sql = "SELECT articles.id, article, id_utilisateur, id_categorie, date, utilisateurs.login, categories.nom FROM articles INNER JOIN utilisateurs ON utilisateurs.id = id_utilisateur INNER JOIN categories ON categories.id = id_categorie ORDER BY id ASC";
        $req = $bdd->prepare($sql);
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function deletArticleDB($id)
    {
        $this->deleteBd($id);
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }
}



