<?php

namespace App\Domain\Service;

use App\Domain\Repository\RepositoryInterface;

abstract class PersonAllService
{
	public static function execute( RepositoryInterface $repository ) : ?array 
	{
		return $repository->all();
	}
}
