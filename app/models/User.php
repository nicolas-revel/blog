<?php


namespace blog\app\models;


class User
{

    //Properties

    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_login;

    /**
     * @var string
     */
    private $_password;

    /**
     * @var string
     */
    private $_mail;

    /**
     * @var int
     */
    private $_droits;

    //Methods

    //setters

    /**
     * @param int | null $id
     */
    public function setId($id): void
    {
        $this->_id = $id;
    }

    /**
     * @param string | null $login
     */
    public function setLogin($login): void
    {
        $this->_login = $login;
    }

    /**
     * @param string | null $password
     */
    public function setPassword($password): void
    {
        $this->_password = $password;
    }

    /**
     * @param string | null $mail
     */
    public function setMail($mail): void
    {
        $this->_mail = $mail;
    }

    /**
     * @param int | null $droits
     */
    public function setDroits($droits): void
    {
        $this->_droits = $droits;
    }

    //getters

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->_login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->_password;
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->_mail;
    }

    /**
     * @return int
     */
    public function getDroits(): int
    {
        return $this->_droits;
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

    static public function getDroitsDb() {
        $pdo = (new User)->connectDB();
        $querystring = "SELECT id, nom FROM droits";
        $result = $pdo->query($querystring);
        

    }

    /**
     * @return array
     */
    public function getUsersDb(): array
    {
        $pdo = $this->connectDB();
        $querystring = "SELECT id, login, password, email, droit FROM utilisateurs";
        $query = $pdo->query($querystring);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * @param $login string
     */
    public function getUserDb(string $login)
    {
        $pdo = $this->connectDB();
        $querystring = "SELECT id, login, password, email, droit FROM utilisateurs WHERE login = :login";
        $query = $pdo->prepare($querystring);
        $query->bindValue(':login', $login);
        $query->execute() or die(print_r($query->errorInfo()));
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $mail
     * @param int $droit
     * @return bool
     */
    public function insertUserDb(string $login, string $password, string $email, int
    $droit) : bool
    {
        $pdo = $this->connectDB();
        $querystring = "INSERT INTO utilisateurs(login, password, email, droit) VALUES (:login, :password, :email, :droit)";
        $query = $pdo->prepare($querystring);
        $query->bindValue(':login', $login);
        $query->bindValue(':password', $password);
        $query->bindValue(':email', $email);
        $query->bindValue(':droit', $droit);
        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function deleteUserDb() : bool
    {
        $pdo = $this->connectDB();
        $querystring = "DELETE FROM utilisateurs WHERE id = {$this->_id}";
        $query = $pdo->query($querystring);
        return $query;
    }

    public function updateUserDb(string $login, string $password, string $email) : bool
    {
        $pdo = $this->connectDB();
        $string = "UPDATE utilisateurs SET login = :login, password = :password, email = :email WHERE id = :id";
        $query = $pdo->prepare($string);
        $query->bindValue(':id', $this->_id);
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
    public function updateUserDroitDb(int $droit, int $id_utilisateur) : bool
    {
        $pdo = $this->connectDB();
        $string = "UPDATE utilisateurs SET droit = :droit WHERE id = :id";
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

