<?php

namespace App\Domain\Service;

use App\Domain\Model\Process;
use App\Domain\Repository\ProcessRepository;

abstract class ProcessUpdateService
{
	public static function execute( 
		\stdClass $processDto, 
		ProcessRepository $processRepository
	) : Process 
	{
		$process = $processRepository->find( $processDto->id );

		$process->integrated = false;
		$process->status = $processDto->status;
		
		$processRepository->update( $process );

		return $process;
	}
}
