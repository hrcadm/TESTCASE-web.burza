<?php

namespace src\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity
 **/
class Person
{
	/**
	* @var int
	*
	* @ORM\Id
	* @ORM\Column(type="integer")
	**/
	public $id;

	/**
	* @var string
	*
	* @ORM\Column(type="text")
	**/
	public $nickname;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     **/
    public $name;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     **/
    public $surname;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     **/
    public $gender;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     **/
    public $is_gamer;
}