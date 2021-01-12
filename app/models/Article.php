<?php


namespace blog\app\models;


class Article
{
    private $id;
    public $article;
    public $id_categorie;
    public $date;

    /**
     * Methode qui permet d'inserer un article dans la base de donnée
     * @param int $article
     * @return void
     */
    public function insertArticle ($categorie, $article, $id_utilisateur, $id_categorie): void {
        //Appel méthode ->getBdd()
        //Requête SQL INSERT INTO table 'article'
    }

    /**
     * Méthode qui permet de modifier un article dans la base de donnée
     * @param int $id
     * @return void
     */
    public function updateArticle (int $id): void {
        //Appel méthode ->getBdd()
        //Requête SQL UPDATE table 'article'
    }

    /**
     * Méthode qui permet la suppresion d'un article dans la base de donnée
     * @param $id
     * @return void
     */
    public function deleteArticle ($id): void {
        //Appel méthode ->getBdd()
        //Requête SQL DELETE table 'article'
    }

    /**
     * Méthode qui permet de récupérer toute les informations et qui seront "stockées" dans les attributs
     * @param $id_utilisateur
     * @return array
     */
    public function findArticle ($id_utilisateur): array {
        //Appel méthode ->getBdd()
        //Requête SQL SELECT * table 'article'
        //Valeurs attribuées aux attributs (PDO::FECTH_OBJ)
    }

    /**
     * Méthode qui permet de récupérer un article par rapport à son id
     * @param $id
     * @return array
     */
    public function find ($id): array {
        //Appel méthode ->getBdd()
        //Requête SQL SELECT * table 'article'
    }

    /**
     * Méthode qui permet de récupérer l'id et le nom des catégories
     * @return array
     */
    public function findCategorie (): array {
        //Appel méthode ->getBdd()
        //Requête SQL SELECT id, nom table 'categorie'
    }

    /**
     * Méthode qui permet de récupérer les 3 derniers articles ou les 5 derniers du plus récent au plus ancien
     * @return array
     */
    public function getArticle (?int $line = ""): array {
        //Appel méthode ->getBdd()
        //Requête = SQL SELECT * FROM LIMIT $line ORDER BY DESC

        if($line){
            $requête .= " LIMIT " . $line;
        }

        $resultats = $this->pdo->query($requête);
        // On fouille le résultat pour en extraire les données réelles
        $articles = $resultats->fetchAll();

    }

    public function getBdd() {

        $pdo = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return $pdo;
    }
    }




}