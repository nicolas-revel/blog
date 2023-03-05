<?php


namespace App\Model;

use App\Entity\User;

/**
 * Class UserController
 * @package blog\src\Model
 */
class UserModel extends AbstractModel
{
    /**
     * @var string
     */
    protected string $tableName = 'user';

    /**
     * @var string
     */
    protected string $className = User::class;

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findOne($id): mixed
    {
        return parent::findOne($id);
    }

}