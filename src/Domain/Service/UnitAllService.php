<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

abstract class UnitAllService
{
	public static function execute( RepositoryInterface $repository ) : ?array 
	{
		return $repository->all();
	}
}
