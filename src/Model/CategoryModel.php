<?php

namespace App\Model;

use App\Entity\Category;

/**
 * Class CategoryModel
 * @package blog\src\Model
 */
class CategoryModel extends AbstractModel
{
    /**
     * @var string
     */
    protected string $tableName = 'category';

    /**
     * @var string
     */
    protected string $className = Category::class;

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function findOne($id): mixed
    {
        return parent::findOne($id);
    }

    public function save($entity): bool
    {
        return parent::save($entity);
    }

    public function delete($id): bool
    {
        return parent::delete($id);
    }


}