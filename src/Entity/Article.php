<?php

namespace App\Entity;

use DateTime;

class Article
{

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
        private ?DateTime $createdAt = null,
        private ?DateTime $updatedAt = null
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

}