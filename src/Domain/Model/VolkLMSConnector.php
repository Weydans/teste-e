<?php

namespace App\Domain\Model;

use GuzzleHttp\Client;

class VolkLMSConnector
{
	const BASE_URL = 'https://dev.evolke.com.br/admin/gabriel/evolke-admin/api/v2/';

	private Process $process;
	private string $token;
	private object $HTTPClient;
	private int $queueId;

	public function __construct( Process $process )
	{
		$this->process = $process;
		$this->HTTPClient = new Client([ 'base_uri' => self::BASE_URL ]); 
		$this->login();
	}

	private function login() : void
	{
		$response = $this->HTTPClient->request(
			'GET', 
			'router.php', 
			[
				'query' => [
					'action' => 'authToken',
					'email'  => 'volklms@evolke.com.br',
					'senha'  => 'volklmsdesafio',
				],
				'headers' => [
					'Accept' => 'application/json',
					'Content-Type' => 'application/json',
				]
			]
		);
		
		$arrResponse = json_decode( $response->getBody(), true );
		$this->token = $arrResponse['result']['access_token'];
	}

	private function addProcessQueue() : void
	{
		$response = $this->HTTPClient->request(
			'GET', 
			'router.php', 
			[
				'query' => [
					'action'     => 'newQueue',
					'id_pessoa'  => $this->process->person->id,
					'id_unidade' => $this->process->unit->id,
					'status'     => $this->process->status,
					'acao_fila'  => $this->process->type,
				],
				'headers' => [
					'Accept' => 'application/json',
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer ' . $this->token,
				]
			]
		);
		
		$arrResponse = json_decode( $response->getBody(), true );
		$this->queueId = $arrResponse['result']['id_fila'];
	}

	private function updateProcessQueue() : void
	{

	}

	private function getProcessFromQueue() : string
	{
		$response = '';
		return $response;
	}

	public function handleProcess() : int
	{
		if ( $this->process->line_position == -1 ) {
			$this->addProcessQueue();
		} else { 
			$this->updateProcessQueue();
		}

		$this->getProcessFromQueue();

		return $this->queueId;
	}
}
