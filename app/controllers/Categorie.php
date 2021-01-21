<?php

namespace blog\app\controllers;

class categorie extends \blog\app\models\categorie {

    /**
     * Méthode qui permet d'insérer les catégories
     */
    public function insertCat() {

        if(!empty($_POST['name'])) {

            $nom = htmlspecialchars($_POST['name']);

        }else {
            die("Votre formulaire à été mal rempli");
        }

        //Expression régulière afin de limiter le nombre de caractères, max 1024
        if(!preg_match("/^[a-zA-Z0-9_:-]{1,80}$/", $nom)) {

            die("Le commentaire doit contenir 1024 caractères maximum");
        }

        $this->insertCategorie($nom);
    }

    /**
     * Méthode qui permet de générer un dropdown dans la navbar avec les noms des categories.
     */
    public function showAllNavBar() {

        $modelCategorie = new \blog\app\models\categorie();
        $all = $modelCategorie->getAllCategorie();

        foreach($all as $key => $value){
            $tab[$value['id']] = $value['nom'];
        }
        return $tab;
    }

    public function showAllId() {

        $modelCategorie = new \blog\app\models\categorie();
        $all = $modelCategorie->getAllCategorie();

        foreach($all as $key => $value){
            $tab[$key] = $value['id'];
        }
        return $tab;
    }

    /**
     * Méthode qui permet de supprimer une categorie
     * @param int $id
     */
    public function deleteCategorie ($id) {

        $this->deleteBd ($id);
    }

    /**
     * Méthode qui permet de modifier une catégorie
     * @param int $id
     */
    public function updateCategorie(int $id) {

        if(!empty($_POST['name'])) {

            $nom = htmlspecialchars($_POST['name']);
            $this->updateCategorieBd($nom, $id);

        }
    }

    public function getAllCat()
    {
        return $this->getAllCategorie();
    }

}