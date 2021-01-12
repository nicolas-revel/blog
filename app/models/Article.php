<?php


namespace blog\app\models;


class Article
{
    protected $table = "articles";

    private $id;
    public $article;
    public $id_categorie;
    public $date;

    /**
     * Methode qui permet d'inserer un article dans la base de donnée
     * @param int $article
     * @return bool
     */
    public function insertArticle (string $article, int $id_utilisateur, int $id_categorie, string $date) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("INSERT INTO articles ($article, $id_utilisateur, $id_categorie, $date) VALUES (:article :id_utilisateur, :id_categorie)");
        $req->bindValue(':article', $article, \PDO::PARAM_STR);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $debut, \PDO::PARAM_INT);
        $req->bindValue(':date', $date, \PDO::PARAM_STR);
        $req->execute()or die(print_r($request->errorInfo()));

    }

    /**
     * Méthode qui permet de modifier un article dans la base de donnée
     * @param int $id
     * @return void
     */
    public function updateArticle (int $id): void {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('UPDATE articles SET article = :article, id_utilisateur = :id_utilisateur, id_categorie = :id_categorie, date = :date WHERE id = "'.$this->id.'"');
        $req->bindValue(':article', $article, \PDO::PARAM_STR);
        $req->bindValue(':id_utilisateur', $id_utilisateur, \PDO::PARAM_INT);
        $req->bindValue(':id_categorie', $debut, \PDO::PARAM_INT);
        $req->bindValue(':date', $date, \PDO::PARAM_STR);
        $req->execute()or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet la suppresion d'un article dans la base de donnée
     * @param $id
     * @return void
     */
    public function delete (int $id): void {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(['id' => $id]);

    }

    /**
     * Méthode qui permet de récupérer toute les informations et qui seront "stockées" dans les attributs
     * @param int $id_utilisateur
     * @return array
     */
    public function findArticle (int $id_utilisateur): array {

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
    public function find (int $id): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, article, id_utilisateur, id_categorie, date FROM articles WHERE id = :id ");
        $req->execute(['id' => $id]);

        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * Méthode qui permet de récupérer l'id et le nom des catégories
     * @return array
     */
    public function findCategorie (): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, nom FROM categories");
        $result = $req->fetch(\PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * Méthode qui permet de récupérer les 3 derniers articles ou les 5 derniers du plus récent au plus ancien
     * @param int $line 3(affichage accueil) ou 5(affichage articles)
     * @return array $articles
     */
    public function getArticle (?int $line = ""): array {

        $bdd = $this->getBdd();

        $req = "SELECT article, date FROM articles"
        //Requête = SQL SELECT article, date FROM articles LIMIT $line ORDER BY date DESC

        if($line){
            $req .= " LIMIT " . $line . "ORDER BY date DESC";
        }

        $result = $bdd->query($req);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $result->fetchAll();

        return $articles;

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
     * @return PDO
     */
    private function getBdd() {

        $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return $pdo;
    }
    }




}