<?php

namespace App\Domain\Model;

use DateTime;
use Lib\Getters;
use Lib\Setters;
use Lib\Issets;
use Lib\Serializeable;
use Lib\SerializeableInterface;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Process implements SerializeableInterface
{
	const TYPE_IMPORT_UNITIES       = 1;
	const TYPE_IMPORT_POSITIONS     = 2;
	const TYPE_IMPORT_SECTORS       = 3;
	const TYPE_IMPORT_PEOLPLE       = 4;
	const TYPE_IMPORT_COURSES       = 5;
	const TYPE_IMPORT_REGISTRATIONS = 6;
	const TYPE_IMPORT_BATCHES		= 7;

	const STATUS_IN_PROGRESS = 1;
	const STATUS_PROCESSED   = 2;
	const STATUS_CANCELED    = 3;

	#[Id]
	#[GeneratedValue]
	#[Column]
	private int $id;
	
	#[ManyToOne(targetEntity: Person::class)]
	private Person $person;
	
	#[ManyToOne(targetEntity: Unit::class)]
	private Unit $unit;
	
	#[Column]
	private int $type;
	
	#[Column]
	private int $status;
	
	#[Column]
	private int $line_position;
	
	#[Column]
	private DateTime $created_at;
	
	#[Column]
	private DateTime $updated_at;

	private $serializeable = [ 
		'id', 
		'person', 
		'unit', 
		'type', 
		'status', 
		'line_position', 
		'created_at', 
		'updated_at' 
	];

	use Getters, Setters, Issets, Serializeable;
	
	public function __construct( 
		string $name,
		Person $person,
		Unit $unit,
		int $type,
		int $status,
		int $line_position = null,
		DateTime $created_at = null,
		DateTime $updated_at = null
	)
	{
		$this->name          = $name;
		$this->person        = $person;
		$this->unit          = $unit;
		$this->type          = $type;
		$this->status        = $status;
		$this->line_position = $line_position;
		$this->created_at    = $created_at;
		$this->updated_at    = $updated_at;	
	}
}
