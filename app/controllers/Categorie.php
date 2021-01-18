<?php

namespace blog\app\controllers;


class categorie extends \blog\app\models\categorie {

    /**
     * Méthode qui permet d'insérer les catégories
     */
    public function insertCat() {

        if(!empty($_POST['name'])) {

            $nom = htmlspecialchars($_POST['name']);
            $this->insertCategorie($nom);
        }
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

        $id = $this->getAllCategorie();
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


}