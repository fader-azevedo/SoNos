<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('criarFoto','AlunoController@getFoto')->name('criarFoto');//salvar foto no diretorio
Route::post('kappa', 'RegisterController@create1')->name('kappa');

/*Inscrica*/
Route::post('/getInscricao','InscricaoController@getInscricao');