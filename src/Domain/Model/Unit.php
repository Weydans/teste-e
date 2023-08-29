<?php

namespace App\Domain\Model;

use Lib\Getters;
use Lib\Setters;
use Lib\Issets;
use Lib\Serializeable;
use Lib\SerializeableInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;

#[Entity]
class Unit implements SerializeableInterface
{
	#[Id]
	#[GeneratedValue]
	#[Column]
	private int $id;
	
	#[Column]
	private string $name;

	private $serializeable = [ 'id', 'name' ];

	use Getters, Setters, Issets, Serializeable;
	
	public function __construct( string $name )
	{
		$this->name = $name;
	}
}
