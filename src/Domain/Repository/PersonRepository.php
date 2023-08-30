<?php

namespace App\Domain\Repository;

use App\Domain\Model\Person;

class PersonRepository extends DoctrineRepository
{
	protected $entityClass = Person::class;
    
	public function __construct()
	{
		parent::__construct();
	}
}
