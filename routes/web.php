<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['as' => 'pages.', 'namespace' => "Pages"], function () {
    Route::get('/', 'PagesController@home')->name("home");
});

Route::group(['as' => 'associados.', 'namespace' => "Associados"], function () {
    Route::get('/associados/agencia', 'AssociadosController@getAssociadosAgencia')->name('agencia');
    Route::resource('associados', 'AssociadosController');
});

Route::group(['as' => 'contas.', 'namespace' => "Contas"], function () {
    Route::get('/contas/agencia', 'ContasController@getAssociadosAgencia')->name('agencia');
    Route::get('/contas/associado/{associado_id}', 'ContasController@getAssociadosContas')->name('contas.associado');
    Route::get('/contas/create/{associado_id}', 'ContasController@create')->name('create');
    Route::get('/contas/agencia/busca', 'ContasController@buscaAssociadosAgencia')->name('agencia.busca');
    Route::resource('contas', 'ContasController');
    Route::post('/contas/importacao', 'ContasController@importacao')->name('importar');

});
