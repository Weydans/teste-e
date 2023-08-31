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
use Doctrine\ORM\Mapping\OneToMany;

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
	
	#[ManyToOne(targetEntity: Person::class, inversedBy: 'processes', cascade: ['persist'])]
	private Person $person;
	
	#[ManyToOne(targetEntity: Unit::class, inversedBy: 'processes', cascade: ['persist'])]
	private Unit $unit;
	
	#[Column]
	private int $type;
	
	#[Column]
	private int $status;
	
	#[Column]
	private int $line_position;

	#[Column]
	private bool $integrated;
	
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
		'integrated', 
		'created_at', 
		'updated_at' 
	];

	use Getters, Setters, Issets, Serializeable;
	
	public function __construct( 
		Person $person,
		Unit $unit,
		int $type,
		int $status,
		int $line_position,
		bool $integrated,
		DateTime $created_at,
		DateTime $updated_at
	)
	{
		$this->person        = $person;
		$this->unit          = $unit;
		$this->type          = $type;
		$this->status        = $status;
		$this->line_position = $line_position;
		$this->integrated    = $integrated;
		$this->created_at    = $created_at;
		$this->updated_at    = $updated_at;	
	}

	public static function ptbrStatusList() : array
	{
		return [
			'Em Andamento' => Process::STATUS_IN_PROGRESS,
			'Processado'   => Process::STATUS_PROCESSED,
			'Cancelado'    => Process::STATUS_CANCELED,
		];
	}

	public static function ptbrActionList() : array 
	{
		return [
			'Importação de unidades'   => Process::TYPE_IMPORT_UNITIES,
			'Importação de cargos'     => Process::TYPE_IMPORT_POSITIONS,
			'Importação de setores'    => Process::TYPE_IMPORT_SECTORS,
			'Importação de pessoas'    => Process::TYPE_IMPORT_PEOLPLE,
			'Importação de cursos'     => Process::TYPE_IMPORT_COURSES,
			'Importação de matrículas' => Process::TYPE_IMPORT_REGISTRATIONS,
			'Certificados em lote'	   => Process::TYPE_IMPORT_BATCHES,
		];
	}
}
