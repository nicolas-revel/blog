<?php


namespace App\Model;

/**
 * Class UserController
 * @package blog\src\Model
 */

class UserModel
{

    //Properties

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $id_droits;

    //Methods

    //setters

    /**
     * @param int | null $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param string | null $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @param string | null $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @param string | null $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @param int | null $droits
     */
    public function setDroits($droits): void
    {
        $this->id_droits = $droits;
    }

    //getters

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getDroits()
    {
        return $this->id_droits;
    }

    // Other Methods


    /**
     * @return \PDO
     */
    protected function connectDB()
    {
        $db = new \PDO("mysql:dbname=blog;host=localhost", "root", "");
        return $db;
    }

    /**
     * @return array
     */
    protected function getUsersDb(): array
    {
        $pdo = $this->connectDB();
        $querystring = "SELECT id, login, password, email, id_droits FROM utilisateurs ORDER BY id ASC";
        $query = $pdo->query($querystring);
        $result = $query->fetchAll(\PDO::FETCH_CLASS,
            '\app\models\User'
        );
        return $result;
    }

    /**
     * @param $login string
     */
    public function getUserDb(string $login)
    {
        $pdo = $this->connectDB();
        $querystring = "SELECT id, login, password, email, id_droits FROM utilisateurs WHERE login = :login";
        $query = $pdo->prepare($querystring);
        $query->bindValue(':login', $login);
        $query->execute() or die(print_r($query->errorInfo()));
        $result = $query->fetchAll(\PDO::FETCH_CLASS, '\app\models\User');
        if (!empty($result)) {
            return $result[0];
        } else {
            return false;
        }
    }

    /**
     * @return array
     */
    protected function getDroitsDb()
    {
        $pdo = $this->connectDB();
        $querystring = "SELECT id, nom FROM droits";
        $query = $pdo->query($querystring);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @param int $droit
     * @return bool
     */
    public function insertUserDb(string $login, string $password, string $email, int $droit): bool
    {
        $pdo = $this->connectDB();
        $querystring = "INSERT INTO utilisateurs(login, password, email, id_droits) VALUES (:login, :password, :email, :id_droits)";
        $query = $pdo->prepare($querystring);
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->bindValue(':email', $email);
        $query->bindValue(':id_droits', $droit);
        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function deleteUserDb($id): void
    {
        $pdo = $this->connectDB();
        $querystring = "DELETE FROM utilisateurs WHERE id = {$id}";
        $query = $pdo->query($querystring);
    }

    public function updateUserDb(string $login, string $password, string $email): bool
    {
        $pdo = $this->connectDB();
        $string = "UPDATE utilisateurs SET login = :login, password = :password, email = :email WHERE id = :id";
        $query = $pdo->prepare($string);
        $query->bindValue(':id', $this->id);
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->bindValue(':email', $email);
        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $droit
     * @param int $id_utilisateur
     * @return bool
     */
    public function updateUserDroitDb(int $droit, int $id_utilisateur): bool
    {
        $pdo = $this->connectDB();
        $string = "UPDATE utilisateurs SET id_droits = :droit WHERE id = :id";
        $query = $pdo->prepare($string);
        $query->bindValue(':id', $id_utilisateur);
        $query->bindValue(':droit', $droit);
        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }
}
$user = new UserModel();