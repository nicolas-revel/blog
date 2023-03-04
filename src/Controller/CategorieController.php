<?php

namespace App\Controller;


class categorie extends \app\models\categorie {

    /**
     * Méthode qui permet d'insérer les catégories
     */
    public function insertCat() {

        $msg_error = "";

        if(!empty($_POST['newcat'])) {

            $nom = htmlspecialchars($_POST['newcat']);

        }else {
            $msg_error = "Votre formulaire à été mal rempli";
        }

        //Expression régulière afin de limiter le nombre de caractères, max 80
        if(!preg_match("/^(?!\s*$)[-a-zA-Z0-9_:,.\s]{1,80}$/", $nom)) {

            $msg_error = "Le commentaire doit contenir 1024 caractères maximum";
        }

        $this->insertCategorie($nom);

        return $msg_error;
    }

    /**
     * Méthode qui permet de générer un dropdown dans la navbar avec les noms des categories.
     */
    public function showAllNavBar() {

        $all= $this->getAllCategorie();

        foreach($all as $key => $value){
            $tab[$value['id']] = $value['nom'];
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

        if(!empty($_POST['newcat'])) {

            $nom = htmlspecialchars($_POST['newcat']);
            $this->updateCategorieBd($nom, $id);

        }
    }

    public function getAllCat()
    {
        return $this->getAllCategorie();
    }

    public function getCategory($id)
    {
        return $this->getCategoryBd($id);
    }

}