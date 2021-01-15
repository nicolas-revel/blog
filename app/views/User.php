<?php


namespace blog\app\views;

require_once("../models/User.php");

/**
 * Class User
 * @package blog\app\views
 */

class User extends \blog\app\models\User
{
    static public function dispAllUsers()
    {
        $users = (new \blog\app\models\User)->getUsersDb();
        var_dump($users);
        foreach ($users as $user) {
            echo "<tr>
                    <td>{$user->getId()}</td>
                    <td>{$user->getLogin()}</td>
                    <td>{$user->getPassword()}</td>
                    <td>" . User::listDroits() . "</td>
                  </tr>";

        }
    }

    /**
     * @return void
     */
    static public function listDroits() :void
    {
        echo "<select>";
        $droits = (new \blog\app\models\User)->getDroitsDb();
        echo "<option value=''></option>";
        foreach ($droits as $droit) {
            echo "<option value='{$droit['id']}'>{$droit['nom']}</option>";
        }
        echo "</select>";
    }
}
User::listDroits();
User::dispAllUsers();