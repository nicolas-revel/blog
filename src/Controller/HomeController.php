<?php

namespace App\Controller;

use App\Entity\Article;
use App\Model\ArticleModel;
use App\Model\CategoryModel;
use App\Model\UserModel;

class HomeController extends AbstractController
{


    /**
     * @return array
     */
    public function getHomepageArticles(): array
    {
        $articleModel = new ArticleModel();
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();

        /** @var Article[] $articles */
        $articles = $articleModel->findAll();

        foreach ($articles as $article) {
            $authorId = $article->getIdUser();
            $author = $userModel->findOne($authorId);
            $article->setAuthor($author);
            $categoryId = $article->getIdCategory();
            $category = $categoryModel->findOne($categoryId);
            $article->setCategory($category);
        }

        return $articles;
    }
}