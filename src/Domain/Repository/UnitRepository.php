<?php

namespace App\Domain\Repository;

use App\Domain\Model\Unit;

class UnitRepository extends DoctrineRepository
{
	protected $entityClass = Unit::class;
    
	public function __construct()
	{
		parent::__construct();
	}
}
