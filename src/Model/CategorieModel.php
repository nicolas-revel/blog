<?php

namespace App\Model;


use app\models\Model;

class categorie extends model {

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
    public function getAllCategorie(): array {

        $req = $this->findCategorieBd();

        foreach($req as $key => $value){
            $this->id = $value['id'];
            $this->nom = $value['nom'];
        }

        return $req;

    }

    /**
     * Méthode qui permet de modifier les categories
     * @param string $nom
     * @param int $id
     */
    public function updateCategorieBd (string $nom, int $id) {

        $bdd = $this->getBdd();

        $req = $bdd->prepare('UPDATE categories SET nom = :nom WHERE id = :id');
        $req->bindValue(':nom', $nom,  \PDO::PARAM_STR);
        $req->bindValue(':id', $id, \PDO::PARAM_INT);
        $req->execute()or die(print_r($req->errorInfo()));
    }

    public function getCategoryBd($id)
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT id, nom FROM categories WHERE id = {$id}");
        $req->execute();
        $result = $req->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

}