<?php

namespace App\Entity;

class User
{
    /**
     * @param int|null $id
     * @param string|null $email
     * @param string|null $password
     * @param string|null $firstname
     * @param string|null $lastname
     * @param int|null $idDroits
     */
    public function __construct(
        private ?int $id = null,
        private ?string $email = null,
        private ?string $password = null,
        private ?string $firstname = null,
        private ?string $lastname = null,
        private ?int $idDroits = null
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
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     * @return User
     */
    public function setPassword(?string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return User
     */
    public function setFirstname(?string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return User
     */
    public function setLastname(?string $lastname): User
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIdDroits(): ?int
    {
        return $this->idDroits;
    }

    /**
     * @param int|null $idDroits
     * @return User
     */
    public function setIdDroits(?int $idDroits): User
    {
        $this->idDroits = $idDroits;
        return $this;
    }

}