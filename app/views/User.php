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
    private function listDroits(): string
    {
        $droits = $this->getAllDroits();
        return "<option value=''></option>
                <option value='{$droits[0]['id']}'>{$droits[0]['nom']}</option>
                <option value='{$droits[1]['id']}'>{$droits[1]['nom']}</option>
                <option value='{$droits[2]['id']}'>{$droits[2]['nom']}</option>";
    }

    private function listEachUsers()
    {
        $users = $this->getUsers();
        $droits = $this->listDroits();
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
        <form method='post'>
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

    public function tableUser()
    {
        $tbody = $this->listEachUsers();
        $vue = <<<HTML
<h2>Liste des utilisateurs</h2>
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
        echo $vue;
    }

    /**
     * @param object $object
     */
    public function displayProfil(object $object)
    {
        echo <<<HTML
<h2>Information utilisateur</h2>
<form action="profil.php" method="post">
<p>Login utilisateur : {$object->getLogin()}</p>
<div>
    <label for="login">Modifier votre login :</label>
    <input type="text" name="login" id="login" placeholder="Votre nouveau Login 
    ici">
</div>
<p>Email utilisateur : {$object->getEmail()}</p>
<div>
    <label for="email">Modifier votre Email :</label>
    <input type="text" name="email" id="email" placeholder="Votre nouveau Email 
    ici">
</div>
<div>
    <label for="password">Modifier votre mot de passe :</label>
    <input type="password" name="password" placeholder="Mot de passe">
</div>
<div>
    <label for="c_password">Confirmez votre nouveau mot de passe :</label>
    <input type="password" name="c_password" placeholder="Mot de passe">
</div>
<input type="submit" name="submit" id="submit">
</form>
HTML;
    }
}