<?php

namespace blog\app\models;

require('../app/models/Article.php');

class categorie extends Article {

    private $id;
    public $nom;


    protected $table = "categories";

    /**
     * Methode qui permet d'insérer un nom de categories
     * @param $nom
     */
    public function insertCategorie (string $nom) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("INSERT INTO categories (nom) VALUES (:nom)");
        $req->bindValue(':nom', $nom, \PDO::PARAM_STR);
        $req->execute()or die(print_r($req->errorInfo()));

    }

    /**
     * Méthode qui permet de récupérer toutes les categories
     * @return array
     */
    public function getAllCategorie (): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, nom FROM categories");
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * Méthode qui retourne une categorie
     * @return array
     */
    public function getCat (): array {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, nom FROM categories");
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_OBJ);

        $this->id = $result->id;
        $this->nom = $result->nom;

        return $result;
    }

    /**
     * Méthode qui permet de modifier les categories
     * @param string $nom
     * @param int $id
     */
    public function updateCategorie (string $nom, int $id) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('UPDATE categories SET nom = :nom WHERE id = :id');
        $req->bindValue(':nom', $nom,  \PDO::PARAM_STR);
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute()or die(print_r($req->errorInfo()));
    }


}