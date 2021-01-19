<?php

namespace blog\app\models;

class model
{

    protected $table;
    protected $where;
    protected $resultWhere;
    /**
     * Méthode qui permet la suppresion d'un article dans la base de donnée
     * @param $id
     * @return void
     */
    public function deleteBd (int $id): void {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $req->execute(['id' => $id]);

    }

    /**
     * Méthode qui permet de récupérer l'id et le nom des catégories
     *
     */
    public function findCategorieBd () {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT id, nom FROM categories");
        $req->execute();
        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * Permet de récupérer tous les articles ou tout les commentaires dans l'ordre décroissant par rapport l'id de la catégorie
     * @param int $premier
     * @param int $parPage
     * @param int $id_categorie
     * @return array
     */
    public function selectArticleWithCategorie(int $premier, int $parPage, int $id_categorie)
    {

        $bdd = $this->getBdd();

        $req = $bdd->prepare("SELECT * FROM {$this->table} WHERE {$this->where} = {$this->resultWhere} ORDER BY date DESC LIMIT :premier, :parpage ");
        $req->bindValue( "$this->resultWhere", $id_categorie, \PDO::PARAM_INT);
        $req->bindValue(':premier', $premier, \PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, \PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getBdd() {

        return new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }
}
