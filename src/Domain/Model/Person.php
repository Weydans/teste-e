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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Person implements SerializeableInterface
{
	#[Id]
	#[GeneratedValue]
	#[Column]
	private int $id;
	
	#[Column]
	private string $name;

	#[OneToMany(targetEntity: Process::class, mappedBy: 'person', cascade: ['persist', 'remove'])]
	private Collection $processes;

	private $serializeable = [ 'id', 'name' ];

	use Getters, Setters, Issets, Serializeable;
	
	public function __construct( string $name )
	{
		$this->name = $name;
		$this->processes = new ArrayCollection();
	}

	public function getProcesses()
	{
		return $this->processes;
	}

	public function setProcesses( Process $process )
	{
		$this->processes->add( $process );
		$process->person = $this;
	}
}
