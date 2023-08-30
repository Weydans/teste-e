<?php

namespace App\Http\Controller;

use Lib\Flash;
use Lib\Controller;
use App\Domain\Service\ProcessAllService;
use App\Domain\Exception\RegisterNotFoundException;
use App\Domain\Model\Process;
use App\Domain\Model\VolkLMSConnector;
use App\Domain\Repository\PersonRepository;
use App\Domain\Repository\ProcessRepository;
use App\Domain\Repository\UnitRepository;
use App\Domain\Service\PersonAllService;
use App\Domain\Service\ProcessCreateService;
use App\Domain\Service\ProcessDeleteService;
use App\Domain\Service\ProcessUpdateService;
use App\Domain\Service\UnitAllService;

class ProcessController extends Controller
{
	public function index() 
	{
		try {
			return $this->responseView( 'datagrid.twig.php', [ 
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'processes'      => ProcessAllService::execute( new ProcessRepository() ),
				'actions'        => Process::ptbrActionList(),
				'statusList'     => Process::ptbrStatusList(),
			]);
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			return $this->responseView( 'datagrid.twig.php', [ 
				'message' => $message 
			]);
		} 
	}

	public function create() 
	{
		try {
			return $this->responseView( 'create.twig.php', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
				'people'         => PersonAllService::execute( new PersonRepository() ),
				'actions'        => Process::ptbrActionList(),
				'unities'        => UnitAllService::execute( new UnitRepository() ),
				'statusList'     => Process::ptbrStatusList(),
			]);

		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			return $this->responseView( 'create.twig.php', [ 
				'errorMessage' => $message 
			]);
		} 
	}

	public function store() 
	{
		try {
			if (    empty( $this->request->name ) 
				 || empty( $this->request->person )
				 || empty( $this->request->unit )
				 || empty( $this->request->status ) 
			) {
				Flash::set(
					'errorMessage', 
					'Todos os campos são de preenchimento obrigatório'
				);

				Flash::set('oldValue', $this->request);

				return header("location: /create");
			}

			$process = ProcessCreateService::execute( 
				$this->request, 
				new ProcessRepository(),
				new PersonRepository(),
			    new UnitRepository()	
			);

			Flash::set( 'successMessage', 'Registro cadastrado com sucesso');

			return header("location: /{$process->id}");
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /create");
		} 
	}

	public function edit() 
	{
		try {
			$process = ( new ProcessRepository() )->find( $this->request->id ); 

			return $this->responseView( 'edit.twig.php', [
				'successMessage' => Flash::get('successMessage'),
				'errorMessage'   => Flash::get('errorMessage'),
				'old'            => Flash::get('oldValue'),
				'people'         => PersonAllService::execute( new PersonRepository() ),
				'actions'        => Process::ptbrActionList(),
				'unities'        => UnitAllService::execute( new UnitRepository() ),
				'statusList'     => Process::ptbrStatusList(),
				'process'        => $process,
			]);

		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			return $this->responseView( 'edit.twig.php', [ 
				'errorMessage' => $message 
			]);
		} 
	}

	public function update() 
	{
		try {
			if ( empty( $this->request->status ) ) {
				Flash::set(
					'errorMessage', 
					'Todos os campos são de preenchimento obrigatório'
				);

				return header("location: /$this->request->id");
			}

			ProcessUpdateService::execute( 
				$this->request, 
				new ProcessRepository() 
			);

			Flash::set( 'successMessage', 'Registro atualizado com sucesso' );

			return header("location: /{$this->request->id}");
		
		} catch ( RegisterNotFoundException $e ) {
			Flash::set( 'errorMessage', 'Registro não encontrado' );
			return header("location: /");
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /{$this->request->id}");
		} 
	}

	public function delete() 
	{
		try {
			ProcessDeleteService::execute(
				$this->request->id, 
				new ProcessRepository() 
			);

			Flash::set( 'successMessage', 'Registro removido com sucesso' );

			return header("location: /");
		
		} catch ( RegisterNotFoundException $e ) {
			Flash::set( 'errorMessage', 'Registro não encontrado' );

			return header("location: /");
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /");
		} 
	}

	public function integrate()
	{
		try {
			$processRepository = new ProcessRepository();
			$process = $processRepository->find( $this->request->id );
			$volk = new VolkLMSConnector( $process );

			$process->line_position = $volk->handleProcess();
			$process->integrated = true;

			$processRepository->update( $process );

			Flash::set( 'successMessage', 'Integração realizada com sucesso' );

			return header("location: /{$this->request->id}");
		
		} catch ( RegisterNotFoundException $e ) {
			Flash::set( 'errorMessage', 'Registro não encontrado' );

			return header("location: /{$this->request->id}");
		
		} catch ( \Exception $e ) {
			$message = $_ENV['APP_DEBUG'] 
				? $e->getMessage() 
				: 'Houve um erro entre em contato com o suporte';

			Flash::set( 'errorMessage', $message );

			return header("location: /{$this->request->id}");
		} 
	}
}
