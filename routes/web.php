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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function() {
	Route::get('/dashboard', 'HomeController@index')->name('home');
	Route::get('/estoque', 'EstoqueController@index')->name('estoque');
	Route::post('/salvar-estoque', 'EstoqueController@store')->name('salvar-estoque');
	Route::get('/baixa-estoque', 'EstoqueController@baixaEstoque')->name('baixa-estoque');
	Route::get('/produtos', 'ProdutosController@index')->name('produtos');
	Route::post('/excluir-produto', 'ProdutosController@delete')->name('excluir-produto');
	Route::post('/editar-produto', 'ProdutosController@update')->name('editar-produto');
	Route::post('/salvar-produto', 'ProdutosController@store')->name('salvar-produto');
	Route::get('/relatorios', 'RelatoriosController@index')->name('relatorios');

});
















