<?php

namespace App\Controller;

use App\Entity\User;
use App\Model\UserModel;
use Exception;

class AuthController extends AbstractController
{

    public function login($login, $password)
    {
        $userModel = new UserModel();

        $password = htmlspecialchars(trim($password));
        $login = htmlspecialchars(trim($login));

        $user = $userModel->findOneBy(['email' => $login]);
        var_dump($user);

        if (password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user;
            $this->redirect('pages/accueil.php');
        }
    }

    public function register($email, $password, $confirmationPassword, $firstname, $lastname)
    {
        $user = new User(
            null,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $firstname,
            $lastname,
            1
        );

        $userModel = new UserModel();
        if ($password === $confirmationPassword) {
            $insert = $userModel->save($user);
        }

        if (!$insert) {
            throw new Exception('Erreur lors de l\'enregistrement de l\'utilisateur');
        } else {
            $this->login($email, $password);
            $this->redirect('pages/accueil.php');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->redirect('pages/accueil.php');
    }

}