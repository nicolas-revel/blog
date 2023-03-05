<?php


namespace App\Model;

use App\Entity\Comment;

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

}