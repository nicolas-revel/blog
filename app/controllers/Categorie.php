<?php

namespace blog\app\controllers;

require("../app/models/Categorie.php");

class categorie {

    /**
     * Méthode qui permet d'insérer les catégories
     */
    public function insertCat() {

        $modelCategorie = new \blog\app\models\categorie();

        if(!empty($_POST['name'])) {

            $nom = htmlspecialchars($_POST['name']);
            $modelCategorie->insertCategorie($nom);
        }
    }

    /**
     * Méthode qui permet de générer un dropdown dans la navbar avec les noms des categories.
     */
    public function showAllNavBar() {

        $modelCategorie = new \blog\app\models\categorie();
        $all = $modelCategorie->getAllCategorie();

        foreach($all as $key => $value){
            $tab[$key] = $value['nom'];
        }
        return $tab;
    }

    /**
     * Méthode qui permet de supprimer une categorie
     * @param int $id
     */
    public function deleteCategorie (int $id) {

        $modelCategorie = new \blog\app\models\categorie();
        $id = $modelCategorie->getAllCategorie();

        $modelCategorie->delete($id['id']);
    }

    /**
     * Méthode qui permet de modifier une catégorie
     * @param int $id
     */
    public function updateCategorie(int $id) {

        $modelCategorie = new \blog\app\models\categorie();

        if(!empty($_POST['name'])) {

            $nom = htmlspecialchars($_POST['name']);
            $modelCategorie->updateCategorie($nom, $id);

        }
    }


}