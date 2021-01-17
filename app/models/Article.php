<?php


namespace blog\app\models;

/**
 * Class Article
 * @package blog\app\models
 */
class Article
{
    protected $table = "articles";

    private $id;
    public $article;
    public $id_categorie;
    public $date;

    /**
     * @param string $article
     * @param int $id_utilisateur
     * @param int $id_categorie
     */
    public function insertArticleDb (string $article, int $id_utilisateur, int $id_categorie) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("INSERT INTO articles (article, id_utilisateur, id_categorie, date) VALUES (:article, :id_utilisateur, :id_categorie, NOW())");
        $req->bindValue(':article', $article);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->execute()or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet de modifier un article dans la base de donnée
     * @param int $id
     * @return void
     */
    public function updateArticleBd (int $id, string $article, int $id_utilisateur, int $id_categorie) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('UPDATE articles SET article = :article, id_utilisateur = :id_utilisateur, id_categorie = :id_categorie, date = NOW() WHERE id = :id');
        $req->bindValue(':article', $article);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute()or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet la suppresion d'un article dans la base de donnée
     * @param $id
     * @return void
     */
    public function deleteBd (int $id): void {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(['id' => $id]);

    }

    /**
     * Méthode qui permet de récupérer toute les informations et qui seront "stockées" dans les attributs
     * @param int $id_utilisateur
     * @return array
     */
    public function findArticleBd (int $id_utilisateur): array {

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
     * Méthode qui permet de récupérer un article par rapport à son id
     * @param int $id
     * @return array
     */
    public function findBd (int $id_article): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, article, id_utilisateur, id_categorie, date FROM articles WHERE id = :id");
        $req->execute(['id' => $id_article]);

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * Méthode qui permet de récupérer l'id et le nom des catégories
     *
     */
    public function findCategorieBd () {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, nom FROM categories");
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }

    public function selectPages($premier, $parPage) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('SELECT * FROM articles ORDER BY date DESC LIMIT :premier, :parpage');
        $req->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();
        $articles = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $articles;
    }

    public function selectArticleWithCategorie ($premier, $parPage, $id_categorie) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM articles WHERE id_categorie = :id_categorie ORDER BY date DESC LIMIT :premier, :parpage ");
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getArticlebyIdCategorie($id_categorie){

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM articles WHERE id_categorie = :id_categorie");
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }

    public function countArticle() {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('SELECT COUNT(*) AS nb_articles FROM articles');
        $req->execute();
        $result = $req->fetch();

        return $result;

    }

    public function countArticleById ($id_categorie) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('SELECT COUNT(*) AS nb_articles FROM articles WHERE id_categorie = :id_categorie');
        $req->bindValue(':id_categorie', $id_categorie, \PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch();

        return $result;

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
 
    /**
     * Méthode qui permet de se connecter à la base de donnée
     * @return \PDO
     */
    public function getBdd() {

        return new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }
    }





