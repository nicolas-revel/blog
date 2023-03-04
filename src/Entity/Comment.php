<?php

namespace App\Entity;

use DateTime;

class Comment
{

    /**
     * @param int|null $id
     * @param string|null $commentText
     * @param int|null $idArticle
     * @param int|null $idUser
     * @param DateTime|null $createdAt
     */
    public function __construct(
        private ?int $id = null,
        private ?string $commentText = null,
        private ?int $idArticle = null,
        private ?int $idUser = null,
        private ?DateTime $createdAt = null
    ) {
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
     * @return Comment
     */
    public function setId(?int $id): Comment
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCommentText(): ?string
    {
        return $this->commentText;
    }

    /**
     * @param string|null $commentText
     * @return Comment
     */
    public function setCommentText(?string $commentText): Comment
    {
        $this->commentText = $commentText;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdArticle(): ?int
    {
        return $this->idArticle;
    }

    /**
     * @param int|null $idArticle
     * @return Comment
     */
    public function setIdArticle(?int $idArticle): Comment
    {
        $this->idArticle = $idArticle;
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
     * @return Comment
     */
    public function setIdUser(?int $idUser): Comment
    {
        $this->idUser = $idUser;
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
     * @return Comment
     */
    public function setCreatedAt(?DateTime $createdAt): Comment
    {
        $this->createdAt = $createdAt;
        return $this;
    }

}