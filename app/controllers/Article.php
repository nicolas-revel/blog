<?php


namespace blog\app\controllers;


class Article extends \blog\app\models\Article
{

    /**
     * Méthode qui traite le formulaire de création d'article puis insère dans la BDD
     * @param $id_utilisateur
     */
    public function insertArticle($id_utilisateur): void {

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


    /**
     * Méthode qui permet de récupérer les noms et ids des categories
     * @return array
     */
    public function tabCategorie(): array {

        $result = $this->findCategorieBd();

        foreach($result as $key => $value){

            $tab[$value['nom']] = intval($value['id']);
        }

        return $tab;
    }

    /**
     * Méthode qui traite le formulaire de modification d'article puis remplace les nouvelles informations dans la BDD
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
     * Méthode qui permet de compter le nombre d'article par rapport à sa categorie
     * @param $withCategorie
     * @return int
     */
    public function nbrArticleId ($withCategorie) {

        if(!empty($_GET['categorie'])){

            $id_categorie = $_GET['categorie'];

            $articles = $this->countArticle($withCategorie, $id_categorie);
            $nbArticles = (int)$articles['nb_articles'];
        }

            return $nbArticles;
    }

    /**
     * Méthode qui permet de supprimer un article par rapport bouton/lien
     * @return void
     */
    public function deletArticle ($id): void {
        $this->deletArticleDB($id);
    }

    /**
     * Méthode qui permet de compter tous les articles présents dans la base de donnée
     * @return int
     */
    public function nbrArticle() {

        $result = $this->countArticle(null, null);
        $nbArticles = (int) $result['nb_articles'];

        return $nbArticles;
    }


    public function createTabArticles()
    {
        return $this->getArticlesAuthors();
    }

}