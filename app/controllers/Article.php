<?php


namespace blog\app\controllers;

require_once("../app/models/Article.php");

class Article extends \blog\app\models\Article
{
    /**
     * Méthode qui traite le formulaire de création d'article puis insère dans la BDD
     * @param int $id_utilisateur
     */
    public function insertArticle($id_utilisateur) {


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

                $this->insertArticleDb($article, $id_utilisateur, $id_categorie);
            }
        }

    }

    public function tabCategorie() {

        $result = $this->findCategorieBd();

        foreach($result as $key => $value){

            $tab[$value['nom']] = intval($value['id']);
        }

        return $tab;
    }

    /**
     * Méthode qui traite de formulaire de modification d'article puis remplace les nouvelles informations dans la BDD
     * @param int $id
     * @param int $id_utilisateur
     * @return void
     */
    public function updateArticle (int $id, int $id_utilisateur) {

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
    public function ArticleAccueil() {

        $getArticle = $this->getArticleBd(3);

        return $getArticle;

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