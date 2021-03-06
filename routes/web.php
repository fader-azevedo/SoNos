<?php
use App\Http\Middleware\Mdw;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'mensalidade'], function (){
    Route::get('/','MensalidadeController@index')->middleware(Mdw::class,'auth');
    Route::get('registar','MensalidadeController@registarMensalidade')->middleware(Mdw::class,'auth');
});

Route::group(['prefix'=>'historico'], function (){
    Route::get('/','HistoricoController@index')->middleware(Mdw::class,'auth');
//    Route::get('registar','MensalidadeController@registarMensalidade')->middleware(Mdw::class,'auth');
});

Route::get('/candidato','AlunoController@candidatoIndex')->name('candidatoIndex')->middleware(Mdw::class,'auth');
Route::resource('aluno','AlunoController');

Route::post('salvarCandidato','RegisterController@teste')->name('salvarCandidato');