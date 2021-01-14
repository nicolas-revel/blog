<?php


namespace blog\app\controllers;


class Article
{
    /**
     * Méthode qui traite le formulaire de création d'article puis insère dans la BDD
     * @param int $id
     * @return void
     */
<<<<<<< Updated upstream
    public function insertArticle (int $id_utilisateur): void {
=======
    public function insertArticle($id_utilisateur): void {

>>>>>>> Stashed changes

        if(!empty ($_POST['categorie']) && ($_POST['article'])) {

            $categorie = htmlspecialchars($_POST['categorie']);
            $article = htmlspecialchars($_POST['article']);

        } else {
            die(" Votre formulaire à été mal rempli ");
        }

<<<<<<< Updated upstream
        $findCat = $this->model->findCategorie();
=======
        $findCat = $this->tabCategorie();
>>>>>>> Stashed changes

        if($findCat['nom'] === $categorie) {

            $id_categorie = $findCat['id'];
            $date = date('Y/m/d H:i:s');

            $this->model->insertArticle($article, $id_utilisateur, $id_categorie, $date);
        }

<<<<<<< Updated upstream
        //Redirection
=======
    }

    /**
     * Méthode qui permet de récupérer les titre et ses id des categories
     * @return array
     */
    public function tabCategorie(): array {

        $result = $this->findCategorieBd();

        foreach($result as $key => $value){

            $tab[$value['nom']] = intval($value['id']);
        }

        return $tab;
>>>>>>> Stashed changes
    }

    /**
     * Méthode qui traite de formulaire de modification d'article puis remplace les nouvelles informations dans la BDD
     * @param int $id
<<<<<<< Updated upstream
     * @return void
     */
    public function updateArticle (int $id): void {
=======
     * @param int $id_utilisateur
     */
    public function updateArticle (int $id, int $id_utilisateur) {
>>>>>>> Stashed changes

        if(!empty ($_POST['categorie']) && ($_POST['article'])) {

            $article = htmlspecialchars($_POST['article']);
            $categorie = htmlspecialchars($_POST['categorie']);

        } else {
            die("Votre formulaire à été mal rempli");
        }

        $findCat = $this->tabCategorie();

        foreach($findCat as $key => $value) {

            if($key === $categorie) {

                $id_categorie = $value;

                $this->updateArticleBd($id, $article, $id_utilisateur, $id_categorie);
            }
        }
    }

    /**
     * Méthode qui permet de supprimer un article par rapport bouton/lien
     * @return void
     */
    public function deletArticle (): void {
        //Traitement des $_GET
        // Appel de la fonction ->findCategorie () pour afficher le nom de la catégorie
        //Appel de la fonction ->findArticle($id_utilisateur) 'blog\app\models' pour récupérer l'id de l'article
        //Appel de la fonction ->delete($id) 'blog\app\models'
        //Redirection
    }

    /**
     * Méthode qui permet d'afficher les 3 premiers articles sur la page d'accueil
     */
    public function showAccueil () {
        // Appel de la fonction ->findCategorie () pour afficher le nom de la catégorie
        //Appel de la fonction ->getThirdArticle () 'blog\app\models'
        // Redirection avec Renderer ?
    }

    /**
     * Méthode qui permet d'afficher l'ensemble des article (max 5) du plus récent au plus ancien + pagination
     */
    public function showArticles () {
        //Traitement de $_GET pour pagination
        // Appel de la fonction ->findCategorie () pour afficher le nom de la catégorie
        //Appel de la fonction ->getFiveArticle () 'blog\app\models'
        // Redirection avec Renderer ?

    }

    /**
     * Méthode qui permet d'afficher un article et ses commentaires
     */
    public function showArticle () {
        //Traitement des $_GET
        //Appel de la fonction ->findArticle($id_utilisateur) 'blog\app\models' pour récupérer l'id de l'article
        //$article = $this->model->find($id);
        //$comment = $this->model->findAllWithArticle($article_id)
        // Redirection avec Renderer ?

    }





}