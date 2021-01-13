<?php

namespace blog\app\models;

require('Article.php');

class categorie extends Article {

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

        $req = $bdd->prepare("SELECT nom FROM categories");
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }

    public function
}