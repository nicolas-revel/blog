<?php


namespace App\Controller;

use App\Model\ArticleModel;
use App\Model\CategoryModel;
use App\Model\CommentModel;
use App\Model\UserModel;

class ArticleController extends AbstractController
{

    public function getFilteredArticles(int $page, ?int $idCategory): array
    {
        $articleModel = new ArticleModel();
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        $articles = $articleModel->findFilteredArticles($page, $idCategory);

        foreach ($articles as $key => $article) {
            $category = $categoryModel->findOne($article->getIdCategory());
            $article->setCategory($category);
            $user = $userModel->findOne($article->getIdUser());
            $article->setAuthor($user);
        }

        return $articles;
    }

    public function getPagination(mixed $param): float
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->findFilteredArticles(null, $param);
        $count = count($articles);

        return ceil($count / 5);
    }

    public function getOneArticleWithComment(mixed $id)
    {
        $articleModel = new ArticleModel();
        $userModel = new UserModel();
        $categoryModel = new CategoryModel();
        $commentModel = new CommentModel();

        $article = $articleModel->findOne($id);
        $article->setCategory($categoryModel->findOne($article->getIdCategory()));
        $article->setAuthor($userModel->findOne($article->getIdUser()));
        $article->setComments($commentModel->findCommentsByArticle($id));
        foreach ($article->getComments() as $comment) {
            $comment->setAuthor($userModel->findOne($comment->getIdUser()));
        }

        return $article;
    }

}