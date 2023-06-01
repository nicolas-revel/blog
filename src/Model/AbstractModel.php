<?php

namespace App\Model;

use PDO;

/**
 * Class AbstractModel
 * @package blog\src\Model
 */
abstract class AbstractModel
{

    /**
     * @var string
     */
    protected string $tableName = '';

    /**
     * @var string
     */
    protected string $className = '';

    /**
     * @var PDO|null
     */
    private ?PDO $bdd = null;


    /**
     * @return PDO
     */
    protected function getBdd(): PDO
    {
        if ($this->bdd === null) {
            return $this->bdd = $this->dbConnect();
        }
        return $this->bdd;
    }

    /**
     * @return PDO
     */
    private function dbConnect(): PDO
    {
        return new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    /**
     * @return array
     */
    protected function findAll(): array
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT * FROM {$this->tableName}");
        $req->execute();
        $results = $req->fetchAll(PDO::FETCH_ASSOC);
        $classes = [];
        foreach ($results as $result) {
            $class = new $this->className(...$result);
            $classes[] = $class;
        }

        return $classes;
    }

    /**
     * @param $id
     * @return false|array
     */
    protected function findOne($id): mixed
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare("SELECT * FROM {$this->tableName} WHERE id = :id");
        $req->execute(['id' => $id]);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = $req->fetch();

        return new $this->className(...$result);
    }

    protected function findOneBy(array $criterias): mixed
    {
        $bdd = $this->getBdd();
        $parameters = [];
        $queryString = "SELECT * FROM {$this->tableName} WHERE ";
        foreach ($criterias as $criteriaKey => $criteriaValue) {
            $queryString .= "$criteriaKey = :$criteriaKey AND";
            $parameters[$criteriaKey] = $criteriaValue;
        }
        $queryString = substr($queryString, 0, -3);
        $req = $bdd->prepare($queryString);
        $req->execute($parameters);
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = $req->fetch();
        if (!$result) {
            return false;
        }
        return new $this->className(...$result);
    }

    /**
     * @param int $id
     * @return bool
     */
    protected function delete(int $id): bool
    {
        $bdd = $this->getBdd();
        $req = $bdd->prepare("DELETE FROM {$this->tableName} WHERE id = :id");
        $req->execute([':id' => $id]);
        return true;
    }

    /**
     * @param $entity
     * @return bool|null
     */
    protected function save($entity): bool|null
    {
        if ($entity->getId() === null && !$this->findOneBy(['email' => $entity->getEmail()])) {
            return $this->insert($entity);
        } elseif ($entity->getId() !== null) {
            $this->update($entity);
        }

        return false;
    }

    /**
     * @param $entity
     * @return bool
     */
    private function insert($entity): bool
    {
        $bdd = $this->getBdd();
        $fields = [];
        $values = [];
        foreach ($entity->getProperties() as $key => $value) {
            $fields[] = $key;
            $values[] = ':' . $key;
        }
        $fields = implode(', ', $fields);
        $values = implode(', ', $values);
        $req = $bdd->prepare("INSERT INTO {$this->tableName} ({$fields}) VALUES ({$values})");
        $req->execute($entity->getProperties());
        $entity->setId($bdd->lastInsertId());

        if ($req->rowCount() === 0) {
            return false;
        }

        return true;
    }

    /**
     * @param $entity
     * @return void
     */
    private function update($entity): void
    {
        $bdd = $this->getBdd();
        $fields = [];
        foreach ($entity->getProperties() as $key => $value) {
            $fields[] = $key . '=:' . $key;
        }
        $fields = implode(', ', $fields);
        $req = $bdd->prepare("UPDATE {$this->tableName} SET {$fields} WHERE id = :id");
        var_dump($entity);
        $req->execute($entity->getProperties());
    }
}
