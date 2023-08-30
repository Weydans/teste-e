<?php

namespace App\Domain\Model;

use GuzzleHttp\Client;

class VolkLMSConnector
{
	private Process $process;
	private string $token;
	private object $HTTPClient;
	private int $queueId;

	public function __construct( Process $process )
	{
		$this->process = $process;
		$this->HTTPClient = new Client([ 'base_uri' => $_ENV['INTEGRATION_URL'] ]); 
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
					'email'  => $_ENV['INTEGRATION_EMAIL'],
					'senha'  => $_ENV['INTEGRATION_PASSWORD'],
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
		$response = $this->HTTPClient->request(
			'GET', 
			'router.php', 
			[
				'query' => [
					'action'  => 'updateQueue',
					'id_fila' => $this->process->line_position,
					'status'  => $this->process->status,
				],
				'headers' => [
					'Accept' => 'application/json',
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer ' . $this->token,
				]
			]
		);
	}

	private function getProcessFromQueue() : void
	{
		$response = $this->HTTPClient->request(
			'GET', 
			'router.php', 
			[
				'query' => [
					'action'  => 'getQueue',
					'id_fila' => $this->process->line_position,
				],
				'headers' => [
					'Accept' => 'application/json',
					'Content-Type' => 'application/json',
					'Authorization' => 'Bearer ' . $this->token,
				]
			]
		);
		
		$arrResponse   = json_decode( $response->getBody(), true );
		$this->queueId = $arrResponse['result']['data'][0]['id'];
	}

	public function handleProcess() : int
	{
		if ( $this->process->line_position == -1 ) {
			$this->addProcessQueue();
		} else { 
			$this->updateProcessQueue();
			$this->getProcessFromQueue();
		}

		return $this->queueId;
	}
}
