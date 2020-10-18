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
    Route::resource('associados', 'AssociadosController');
});

Route::group(['as' => 'contas.', 'namespace' => "Contas"], function () {
    Route::resource('contas', 'ContasController');
    Route::post('/contas/importacao', 'ContasController@importacao')->name('importar');
});
