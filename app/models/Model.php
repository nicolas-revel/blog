<?php

namespace blog\app\models;

/**
 * Class Model
 * @package blog\app\models
 */
class Model
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

    public function getBdd() {

        return new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }
}
