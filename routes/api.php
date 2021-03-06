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
use Illuminate\Support\Facades\Route;

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::namespace('Api')->group(function () {
    Route::get('/componentes', 'ComponentesController@all')->name('api.componentes'); 
    Route::get('/componentes/inicial', 'ComponentesController@statusInicial')->name('api.componentes.inicial'); 
    Route::get('/componentes/atual', 'ComponentesController@statusAtual')->name('api.componentes.atual');
    Route::get('/componente/show/{id}', 'ComponentesController@show')->name('api.componente.show');
    Route::put('/componente/sinal/update', 'ComponentesController@updateSinal')->name('api.componente.sinal.update');
    Route::get('/informacoes', 'InformacoesController@all')->name('api.informacoes');
    Route::get('/informacoes/{id}', 'InformacoesController@show')->name('api.informacao');
    Route::get('/informacao/data-hora', 'InformacoesController@fusoHorarios')->name('api.informacao.datetime');
    Route::post('/distancia/post', 'DistanciaController@post')->name('api.distancia.post');
    Route::get('/distancia/show', 'DistanciaController@show')->name('api.distancia.show');
    Route::post('/presenca/post', 'PresencaController@post')->name('api.presenca.post');
    Route::get('/presenca/show', 'PresencaController@show')->name('api.presenca.show');

});