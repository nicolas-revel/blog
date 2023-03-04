<?php


namespace App\Controller;

use app\ErrorMessage;
use App\Model\UserModel;

/**
 * Class UserController
 * @package blog\src\AbstractController
 */
class UserController extends UserModel
{

    //Properties

    /**
     * @var bool
     */
    protected bool $isconnected;

    //Setters

    /**
     * @param bool $isconnected
     */
    public function setIsconnected(bool $isconnected): void
    {
        $this->isconnected = $isconnected;
    }

    //Getters

    /**
     * @return bool
     */
    public function getIsconnected(): bool
    {
        return $this->isconnected;
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
        $userExist = (new \app\models\User)->getUserDb($login);
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
     * @return object
     */
    public function getUser(string $login): object
    {
        return $this->getUserDb($login);
    }

    public function getUserProfil()
    {
        if ($this->getIsconnected() === true) {
            $profilvue = new \app\views\User;
            return $profilvue->displayProfil($this);
        }
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
            \app\Http::redirect('connexion.php');
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param string $login
     * @param string $password
     * @return UserController|false
     */
    public function connectUser(string $login, string $password)
    {
        $login = htmlspecialchars(trim($login));
        $password = htmlspecialchars(trim($password));
        $userDb = $this->getUserDb($login);
        if (!empty($userDb) && password_verify($password, $userDb->getPassword()
        )) {
            $this->setId($userDb->getId());
            $this->setLogin($userDb->getLogin());
            $this->setPassword($userDb->getPassword());
            $this->setEmail($userDb->getEmail());
            $this->setDroits($userDb->getDroits());
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
        $this->setEmail(null);
        $this->setDroits(null);
        return true;
    }

    /**
     * @param string|null $login
     * @param string|null $password
     * @param string|null $c_password
     * @param string|null $email
     * @return bool
     */
    public function updateUser(string $login = null, string $password = null,
                               string $c_password = null, string $email =
                               null):
    bool
    {
        if (!empty($login) && self::checkLoginValidity($login)) {
            $login = htmlspecialchars(trim($login));
            $this->setLogin($login);
        }
        if (!empty($password) && self::checkPassword($password, $c_password)) {
            $password = htmlspecialchars(trim(password_hash($password,
                PASSWORD_BCRYPT)));
            $this->setPassword($password);
        }
        if (!empty($email)) {
            $email = htmlspecialchars(trim($email));
            $this->setEmail($email);
        }
        $try = $this->updateUserDb($this->getLogin(), $this->getPassword(),
            $this->getEmail());
        if ($try === true) {
            $this->getUser($this->getLogin());
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param int $droit
     * @param int $id_utilisateur
     */
    public
    function updateUserDroit(int $droit, int $id_utilisateur)
    {
        $this->updateUserDroitDb($droit, $id_utilisateur);
    }

    /**
     * @param string $criteria
     */
    public
    function chooseAdminTab($criteria)
    {
        if ($criteria === "users" || $criteria === null) {
            $tabvue = new \app\views\User;
            $tabvue->tableUser();
        }
        if ($criteria === "art") {
            $articles = new \app\views\Article();
            $articles->tableArticle();
        }
        if ($criteria === "com") {
            $commentaires = new \app\views\Comment();
            $commentaires->tableComment();
        }
        if ($criteria === "cat") {
            $cat = new \app\views\categorie();
            $cat->tableCategorie();
        }
    }

    public function deleteUser($id)
    {
        $this->deleteUserDb($id);
    }

    public function getIdUser () {
        return $this->getId();
    }

}