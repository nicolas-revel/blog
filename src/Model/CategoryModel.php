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

    public function save($entity): void
    {
        parent::save($entity);
    }

    public function delete($id): void
    {
        parent::delete($id);
    }


}