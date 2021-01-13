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


    //Public Methods

    /**
     * @param string $login
     * @return bool
     */
    public function checkLoginValidity (string $login) : bool
    {
        $userExist = $this->getUserDb($login);
        var_dump($userExist);
        if (!empty($userExist)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $c_password
     * @param string $email
     * @param int $droit
     * @return bool
     */
    public function insertUser(string $login, string $password, string $c_password, string $email, int $droit = 1) : bool
    {
     /*
      * Si password checked, mail bien formaté et mdp bien formaté
      * échapper tous les paramètres
      * Envoie tous les paramètres
      */
    }

    /**
     * @param string $login
     * @param string $password
     */
    public function connectUser(string $login, string $password)
    {
        /*
         * getUser;
         * passwordverify;
         * Si password verify = true,
         * Set les différentes valeurs de mon objet
         */
    }

    public function disconnectUser()
    {
        /*
         * Set toutes les valeurs à null
         */
    }

    /**
     * @param string $login
     * @param string $password
     * @param string $email
     * @return bool
     */
    public function updateUser(string $login, string $password, string $email) : bool
    {
        /*
         * Si le login existe pas alors continue
         * échape tous les paramêtres
         * envoie tous les paramêtre à updateUserDb
         */
    }

    /**
     * @param int $droit
     * @return bool
     */
    public function updateUserDroit(int $droit) : bool
    {
        /*
         * Si getDroit = 1337
         * alors envoie les droit à la fonction updateUserDroitDb et return true
         * sinon return false
         */
    }
}

$user = new User();
var_dump($user->checkLoginValidity('Jhon'));
var_dump(User::checkPasswordFormat('Allo2!'));
var_dump(User::checkMailFormat(''));