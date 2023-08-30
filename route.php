<?php

use App\Http\Controller\ProcessController;

$route = new Lib\Route( new Lib\Request() );

$route->get( '/', ProcessController::class, 'index' );
$route->get( '/create', ProcessController::class, 'create' );
$route->post( '/store', ProcessController::class, 'store' );
$route->get( '/$id', ProcessController::class, 'edit' );
$route->put( '/update/$id', ProcessController::class, 'update' );
$route->delete( '/delete/$id', ProcessController::class, 'delete' );
$route->post( '/integrate/$id', ProcessController::class, 'integrate' );
