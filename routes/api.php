<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(
    [], 
    function () use ($router) {
		$router->get('/pessoa_fisica', '\App\Http\Controllers\PessoaFisicaController@index');
		$router->get('/pessoa_fisica/{id}', '\App\Http\Controllers\PessoaFisicaController@show');
		$router->post('/pessoa_fisica', '\App\Http\Controllers\PessoaFisicaController@store');
		$router->patch('/pessoa_fisica', '\App\Http\Controllers\PessoaFisicaController@update');
		$router->patch('/pessoa_fisica/{id}', '\App\Http\Controllers\PessoaFisicaController@destroy');
		
		$router->get('/inscricao', '\App\Http\Controllers\InscricaoController@index');
		$router->get('/inscricao/{id}', '\App\Http\Controllers\InscricaoController@show');
		$router->post('/inscricao', '\App\Http\Controllers\InscricaoController@store');
		$router->patch('/inscricao', '\App\Http\Controllers\InscricaoController@update');
		$router->patch('/inscricao/{id}', '\App\Http\Controllers\InscricaoController@destroy');

		$router->get('/estado', '\App\Http\Controllers\EstadoController@getAll');
		$router->get('/estado/{id}', '\App\Http\Controllers\EstadoController@getById');
		$router->post('/estado', '\App\Http\Controllers\EstadoController@store');
		$router->patch('/estado', '\App\Http\Controllers\EstadoController@update');
		$router->patch('/estado/{id}', '\App\Http\Controllers\EstadoController@destroy');

		$router->get('/cidade', '\App\Http\Controllers\CidadeController@getAll');
		$router->get('/cidade/{id}', '\App\Http\Controllers\CidadeController@getById');
		$router->post('/cidade', '\App\Http\Controllers\CidadeController@store');
		$router->patch('/cidade', '\App\Http\Controllers\CidadeController@update');
		$router->patch('/cidade/{id}', '\App\Http\Controllers\CidadeController@destroy');

		//Extra routes

		$router->get('/cidade/de_estado/{id}', '\App\Http\Controllers\CidadeController@getAllFromState');

		$router->get('/pessoa_fisica/by_cpf/{cpf}', '\App\Http\Controllers\PessoaFisicaController@findByCpf');

		$router->post('/inscricao/by_cargo_pessoa', '\App\Http\Controllers\InscricaoController@getByPersonIdAndPosition');
    }
);