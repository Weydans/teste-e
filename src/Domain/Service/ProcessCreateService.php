<?php

namespace App\Domain\Service;

use App\Domain\Model\Process;
use App\Domain\Repository\PersonRepository;
use App\Domain\Repository\ProcessRepository;
use App\Domain\Repository\UnitRepository;
use DateTime;

abstract class ProcessCreateService
{
	public static function execute( 
		\stdClass $processDto, 
		ProcessRepository $processRepository,
		PersonRepository $personRepository,
		UnitRepository $unitRepository,
	) : Process 
	{
		$person  = $personRepository->find( $processDto->person );
		$unit 	 = $unitRepository->find( $processDto->unit );
		$process = new Process( 
			$person, 
			$unit, 
			$processDto->name, 
			$processDto->status, 
			-1, 
			false,
			new DateTime('now'),
			new DateTime('now')	
		);

		$processRepository->create( $process );

		return $process;
	}
}
