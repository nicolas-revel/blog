<?php



namespace blog\app\controllers;

/**
 * Class User
 * @package blog\app\controllers
 */

require_once('../models/User.php');

class User extends \blog\app\models\User
{

    //Static methods

    /**
     * @param string $password
     * @param string $c_password
     * @return bool
     */
    static public function checkPassword(string $password, string $c_password) : bool
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
    static public function checkMailFormat(string $email) : bool
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
    static public function checkPasswordFormat (string $password) : bool
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
    static public function checkLoginValidity (string $login) : bool
    {
        $userExist = (new \blog\app\models\User)->getUserDb($login);
        if (!empty($userExist)) {
            return false;
        } else {
            return true;
        }
    }

    //Public Methods

    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @param int $droit
     * @return bool
     */
    public function insertUser(string $login, string $password, string $email, int $droit = 1) : bool
    {
        if (!empty($login) && !empty($password) && !empty($email)) {
            $this->setLogin(htmlspecialchars(trim($login)));
            $this->setPassword(htmlspecialchars(trim(password_hash($password,
                PASSWORD_BCRYPT))));
            $this->setMail(htmlspecialchars(trim($email)));
            $this->setDroits($droit);
            $this->insertUserDb($this->getLogin(),$this->getPassword(),
                $this->getMail(),$this->getDroits());
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
        if (password_verify($password,$userDb['password'])) {
            $this->setId($userDb['id']);
            $this->setLogin($userDb['login']);
            $this->setPassword($userDb['password']);
            $this->setMail($userDb['email']);
            $this->setDroits($userDb['droit']);
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
                               string $email = null) : bool
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
            $try = $this->updateUserDb($this->getLogin(),$this->getPassword(),
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
    public function updateUserDroit(int $droit, int $id_utilisateur) : bool
    {
        if ($this->updateUserDroitDb($droit,$id_utilisateur) === true) {
            return true;
        } else {
            return false;
        }
    }
}

$user = new User();