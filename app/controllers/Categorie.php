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

    public function showAll() {

        $modelCategorie = new \blog\app\models\categorie();
        $all = $modelCategorie->getAllCategorie();

        foreach($all as $key => $value){

            echo "<li><a class='dropdown-item' href=''>".$value['nom']."</a></li>";

        }


    }
}