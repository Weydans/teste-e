<?php

namespace App\Domain\Repository;

use App\Domain\Model\Process;

class ProcessRepository extends DoctrineRepository
{
	protected $entityClass = Process::class;
    
	public function __construct()
	{
		parent::__construct();
	}
}
