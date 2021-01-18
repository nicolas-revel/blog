<?php


namespace blog\app\views;

/**
 * Class User
 * @package blog\app\views
 */

class User extends \blog\app\controllers\User
{
    /**
     * @return string
     */
    static public function listDroits(): string
    {
        $droits = (new \blog\app\models\User)->getDroitsDb();
        return "<option value=''></option>
                <option value='{$droits[0]['id']}'>{$droits[0]['nom']}</option>
                <option value='{$droits[1]['id']}'>{$droits[1]['nom']}</option>
                <option value='{$droits[2]['id']}'>{$droits[2]['nom']}</option>";
    }

    static public function listEachUsers()
    {
        $users = (new \blog\app\models\User)->getUsersDb();
        $droits = User::listDroits();
        $tbody = "";
        foreach ($users as $user) {
            $userDroits = \blog\app\controllers\User::convertDroits
            ($user->getDroits());
            $tbody = $tbody . <<<HTML
<tr>
    <th>{$user->getId()}</th>
    <td>{$user->getLogin()}</td>
    <td>{$user->getEmail()}</td>
    <td>{$userDroits}</td>
    <td>
        <form method='get'>
            <select name='droituser' id='droituser'>
                {$droits}
            </select>
            <input type='text' id='userid' name='userid' value='{$user->getId()}' style='display: none'>                            
            <input type='submit' value='Maj Droits' id='submit' name='submit'> 
        </form>
    </td>
    <td>
        <a href='{$_SERVER['PHP_SELF']}?del={$user->getId()}'>Supprimer l'utilisateur</a>
    </td>
</tr>
HTML;
        }
        return $tbody;
    }

    static public function tableUser()
    {
        $tbody = User::listEachUsers();
        $table = <<<HTML
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Email</th>
            <th>Droits</th>
            <th>Modifier Droits</th>
            <th>Supprimer l'utilisateur</th>
        </tr>
    </thead>
    <tbody>
        {$tbody}
    </tbody>
</table>
HTML;
        return $table;

    }
}
