<?php


namespace App\Model;

use App\Entity\Comment;
use PDO;

/**
 * Class CommentModel
 * @package blog\src\Model
 */
class CommentModel extends AbstractModel
{
    /**
     * @var string
     */
    protected string $tableName = 'comment';
    /**
     * @var string
     */
    protected string $className = Comment::class;

    public function findCommentsByArticle(mixed $id)
    {
        $bdd = $this->getBdd();
        $query = $bdd->prepare("select * from comment where idArticle = :idArticle");
        $query->bindValue('idArticle', $id, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $key => $result) {
            $comment = new Comment(...$result);
            $results[$key] = $comment;
        }

        return $results;
    }

}