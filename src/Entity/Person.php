<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Exception\InvalidValueException;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"get"}},
 *     itemOperations={
 *         "get",
 *         "put"={
 *             "normalization_context"={"groups"={"put"}}
 *         },
 *         "delete"
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @Groups({"get"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"get"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nickname;

    /**
     * @Groups({"put"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"put"})
     * @ORM\Column(type="string", length=255)
     */
    private $surname;

    /**
     * @Groups({"put"})
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @Groups({"get", "put"})
     * @ORM\Column(type="boolean")
     */
    private $isGamer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        if(strlen($nickname) < 8)
        {
            throw new InvalidValueException('Nickname too short, min 8 chars!', 422);
        }

        $this->nickname = $nickname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        if(strlen($name) < 2)
        {
            throw new InvalidValueException('Name too short!', 422);
        }

        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        if(strlen($surname) < 2)
        {
            throw new InvalidValueException('Surname too short!', 422);
        }

        $this->surname = $surname;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        if($gender !== 'M' && $gender !== 'F')
        {
            throw new InvalidValueException('Invalid gender!', 422);
        }

        $this->gender = $gender;

        return $this;
    }

    public function getIsGamer(): ?bool
    {
        return $this->isGamer;
    }

    public function setIsGamer(bool $isGamer): self
    {
        $this->isGamer = $isGamer;

        return $this;
    }
}
