<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

abstract class ProcessAllService
{
	public static function execute( RepositoryInterface $repository ) : ?array 
	{
		return $repository->all();
	}
}
