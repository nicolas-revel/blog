<?php

namespace App\Controller;

use App\Model\UserModel;

class AdminController extends AbstractController
{

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        $userModel = new UserModel();

        return $userModel->findAll();
    }

}