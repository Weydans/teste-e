<?php

namespace App\Domain\Service;

use App\Domain\Model\VolkLMSConnector;
use App\Domain\Repository\ProcessRepository;

final class ProcessIntegrationService
{
	public static function execute( 
		int $processId,
		ProcessRepository $processRepository
	) : void
	{
		$process = $processRepository->find( $processId );
		$volk	 = new VolkLMSConnector( $process );

		$process->line_position = $volk->handleProcess();
		$process->integrated = true;

		$processRepository->update( $process );
	}
}
