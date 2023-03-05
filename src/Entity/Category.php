<?php

namespace App\Entity;

/**
 * Class Category
 * @package App\Entity
 */
class Category
{

    /**
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(
        private ?int $id = null,
        private ?string $name = null
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
     * @return Category
     */
    public function setId(?int $id): Category
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Category
     */
    public function setName(?string $name): Category
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return get_object_vars($this);
    }

}