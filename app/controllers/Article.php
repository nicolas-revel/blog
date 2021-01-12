<?php


namespace blog\app\controllers;


class Article
{
    /**
     * Méthode qui traite le formulaire de création d'article puis insère dans la BDD
     * @param int $id
     * @return void
     */
    public function insertArticle (int $id_utilisateur): void {

        if(!empty ($_POST['categorie']) && ($_POST['article'])) {

            $categorie = htmlspecialchars($_POST['categorie']);
            $article = htmlspecialchars($_POST['article']);

        } else {
            die(" Votre formulaire à été mal rempli ");
        }

        $findCat = $this->model->findCategorie();

        if($findCat['nom'] === $categorie) {

            $id_categorie = $findCat['id'];
            $date = date('Y/m/d H:i:s');

            $this->model->insertArticle($article, $id_utilisateur, $id_categorie, $date);
        }

        //Redirection
    }

    /**
     * Méthode qui traite de formulaire de modification d'article puis remplace les nouvelles informations dans la BDD
     * @param int $id
     * @return void
     */
    public function updateArticle (int $id): void {

        // Traitement des $_GET
        //Traitement du formulaire 'creer_article'
        //Appel de la fonction ->updateArticle($id) 'blog\app\models'
        //Redirection
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