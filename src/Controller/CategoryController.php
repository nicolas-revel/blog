<?php

namespace App\Controller;

use App\Model\CategoryModel;

class CategoryController extends AbstractController
{

    public function getAllCategories(): array
    {
        $categoryModel = new CategoryModel();

        return $categoryModel->findAll();
    }
}