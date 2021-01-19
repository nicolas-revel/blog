<?php


namespace blog\app\controllers;

/**
 * Class User
 * @package blog\app\controllers
 */
class User extends \blog\app\models\User
{

    //Properties

    /**
     * @var bool
     */
    protected bool $isconnected;

    //Getters

    /**
     * @return bool
     */
    public function getIsconnected(): bool
    {
        return $this->isconnected;
    }

    //Setters

    /**
     * @param bool $isconnected
     */
    public function setIsconnected(bool $isconnected): void
    {
        $this->isconnected = $isconnected;
    }

    //Static methods

    /**
     * @param string $password
     * @param string $c_password
     * @return bool
     */
    static public function checkPassword(string $password, string $c_password): bool
    {
        if ($password === $c_password) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     * @return bool
     */
    static public function checkMailFormat(string $email): bool
    {
        if (!preg_match("/^[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}$/",
            $email)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Define RegEx for password that need at least:
     * - 1 or more capital letter;
     * - 1 or more non-capital letter;
     * - 1 or more special symbols between '€$!?#@&'
     * - No whitespace and no symbols as '/<>'
     * @param string $password
     * @return bool
     */
    static public function checkPasswordFormat(string $password): bool
    {
        $number = preg_match("/[0-9]+/i", $password);
        $uppercase = preg_match("/[A-Z]+/i", $password);
        $lowercase = preg_match("/[a-z]+/i", $password);
        $specialcaract = preg_match("/[€$!?#@&]+/i", $password);
        $forbidencaract = preg_match('/[\/<>\s]/i', $password);
        if ($number === 0 || $uppercase === 0 || $lowercase === 0 ||
            $specialcaract === 0 || $forbidencaract === 1) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param string $login
     * @return bool
     */
    static public function checkLoginValidity(string $login): bool
    {
        $userExist = (new \blog\app\models\User)->getUserDb($login);
        if (!empty($userExist)) {
            return false;
        } else {
            return true;
        }
    }

    static public function convertDroits(int $droits)
    {
        if ($droits === 1) {
            return "utilisateur";
        } elseif ($droits === 42) {
            return "modérateur";
        } elseif ($droits === 1337) {
            return "administrateur";
        }
    }

    //Public Methods

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->getUsersDb();
    }

    /**
     * @return array
     */
    public function getAllDroits(): array
    {
        return $this->getDroitsDb();
    }

    /**
     * @param string $login
     * @return array
     */
    public function getUser(string $login): array
    {
        return $this->getUsersDb();
    }

    public function getUserProfil()
    {
        $profilvue = new \blog\app\views\User;
        return $profilvue->displayProfil();
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @param int $droit
     * @return bool
     */
    public function insertUser(string $login, string $password, string $email, int $droit = 1): bool
    {
        if (!empty($login) && !empty($password) && !empty($email)) {
            $this->setLogin(htmlspecialchars(trim($login)));
            $this->setPassword(htmlspecialchars(trim(password_hash($password,
                PASSWORD_BCRYPT))));
            $this->setEmail(htmlspecialchars(trim($email)));
            $this->setDroits($droit);
            $this->insertUserDb($this->getLogin(), $this->getPassword(),
                $this->getEmail(), $this->getDroits());
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $login
     * @param string $password
     * @return User|false
     */
    public function connectUser(string $login, string $password)
    {
        $login = htmlspecialchars(trim($login));
        $password = htmlspecialchars(trim($password));
        $userDb = $this->getUserDb($login);
        if (password_verify($password, $userDb[0]->getPassword())) {
            $this->setId($userDb[0]->getId());
            $this->setLogin($userDb[0]->getLogin());
            $this->setPassword($userDb[0]->getPassword());
            $this->setEmail($userDb[0]->getEmail());
            $this->setDroits($userDb[0]->getDroits());
            $this->setIsconnected(true);
            return $this;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function disconnectUser(): bool
    {
        $this->setId(null);
        $this->setLogin(null);
        $this->setPassword(null);
        $this->setMail(null);
        $this->setDroits(null);
        return true;
    }

    /**
     * @param string|null $login
     * @param string|null $password
     * @param string|null $email
     * @return bool
     */
    public function updateUser(string $login = null, string $password = null,
                               string $email = null): bool
    {
        if (!empty($login)) {
            $login = htmlspecialchars(trim($login));
            $this->setLogin($login);
        }
        if (!empty($password)) {
            $password = htmlspecialchars(trim(password_hash($password,
                PASSWORD_BCRYPT)));
            $this->setPassword($password);
        }
        if (!empty($email)) {
            $email = htmlspecialchars(trim($email));
            $this->setMail($email);
        }
        $checklogin = self::checkLoginValidity($this->getLogin());
        if ($checklogin === true) {
            $try = $this->updateUserDb($this->getLogin(), $this->getPassword(),
                $this->getMail());
            if ($try === true) {
                $this->setLogin($login);
                $this->setPassword($password);
                $this->setMail($email);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param int $droit
     * @param int $id_utilisateur
     * @return bool
     */
    public function updateUserDroit(int $droit, int $id_utilisateur): bool
    {
        if ($this->updateUserDroitDb($droit, $id_utilisateur) === true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $criteria
     */
    public function chooseAdminTab($criteria)
    {
        if ($criteria === "users" || $criteria === null) {
            $tabvue = new \blog\app\views\User;
            $tabvue->tableUser();
        }
        if ($criteria === "art") {
            \blog\app\views\Article::tableArticle();
        }
    }

}