<?php

namespace App\Entity;

use DateTime;

/**
 * Class Article
 * @package App\Entity
 */
class Article
{
    private ?User $author;

    private ?Category $category;
    private ?array $comments = [];

    /**
     * @param int|null $id
     * @param string|null $title
     * @param string|null $content
     * @param int|null $idUser
     * @param int|null $idCategory
     * @param DateTime|null $createdAt
     * @param DateTime|null $updatedAt
     */
    public function __construct(
        private ?int $id = null,
        private ?string $title = null,
        private ?string $content = null,
        private ?int $idUser = null,
        private ?int $idCategory = null,
        private null|DateTime|string $createdAt = null,
        private null|DateTime|string $updatedAt = null
    ) {
        if (gettype($this->createdAt) === 'string') {
            $this->createdAt = new DateTime($this->createdAt);
        }
        if (gettype($this->updatedAt) === 'string') {
            $this->updatedAt = new DateTime($this->updatedAt);
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Article
     */
    public function setId(?int $id): Article
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Article
     */
    public function setTitle(?string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return Article
     */
    public function setContent(?string $content): Article
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    /**
     * @param int|null $idUser
     * @return Article
     */
    public function setIdUser(?int $idUser): Article
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }

    /**
     * @param int|null $idCategory
     * @return Article
     */
    public function setIdCategory(?int $idCategory): Article
    {
        $this->idCategory = $idCategory;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     * @return Article
     */
    public function setCreatedAt(?DateTime $createdAt): Article
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     * @return Article
     */
    public function setUpdatedAt(?DateTime $updatedAt): Article
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return get_object_vars($this);
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return Article
     */
    public function setCategory(?Category $category): Article
    {
        $this->category = $category;
        return $this;
    }

    public function setComments($comments): static
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * @return Comment[]|null
     */
    public function getComments(): ?array
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        $this->comments[] = $comment;

        return $this;
    }

}