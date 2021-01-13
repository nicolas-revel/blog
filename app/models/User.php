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
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->_id = $id;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->_login = $login;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->_password = $password;
    }

    /**
     * @param string $mail
     */
    public function setMail(string $mail): void
    {
        $this->_mail = $mail;
    }

    /**
     * @param int $droits
     */
    public function setDroits(int $droits): void
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
     * @return array
     */
    public function getUserDb(string $login): array
    {
        $pdo = $this->connectDB();
        $querystring = "SELECT id, login, password, email, droit FROM utilisateurs WHERE login = :login";
        $query = $pdo->prepare($querystring);
        $query->bindValue(':login', $login);
        $query->execute() or die(print_r($query->errorInfo()));
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        return $result;
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
        $query->execute() or die(print_r($query->errorInfo()));
        return $query;
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
        $query->execute() or die(print_r($query->errorInfo()));
        return $query;
    }

    /**
     * @param int $droit
     * @return bool
     */
    public function updateUserDroitDb(int $droit) : bool
    {
        $pdo = $this->connectDB();
        $string = "UPDATE utilisateurs SET droit = :droit WHERE id = :id";
        $query = $pdo->prepare($string);
        $query->bindValue(':id', $this->_id);
        $query->bindValue(':droit', $droit);
        $query->execute();
        return $query;
    }
}