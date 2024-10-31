<?php


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

use Automacao\Http\Controllers\Api\DataHoraContoller;
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
    Route::get('/informacao/fuso-horario', 'InformacoesController@fusoHorarios')->name('api.informacao.fusohorario');
    Route::get('/informacao/data-hora', 'InformacoesController@dataHora')->name('api.informacao.datahora');
    Route::get('/informacao/data-hora/{id}', 'InformacoesController@city')->name('api.informacao.cidade');
    Route::post('/distancia/post', 'DistanciaController@post')->name('api.distancia.post');
    Route::get('/distancia/show', 'DistanciaController@show')->name('api.distancia.show');
    Route::post('/presenca/post', 'PresencaController@post')->name('api.presenca.post');
    Route::get('/presenca', 'PresencaController@show')->name('api.presenca.show');
    Route::get('/presencas', 'PresencaController@index')->name('api.presenca.index');
    
    Route::get('/temperaturas', 'TemperaturasController@index')->name('api.temperaturas.index');
    Route::post('/temperaturas', 'TemperaturasController@create')->name('api.temperaturas.create');
    Route::get('/temperaturas/max/temperatura', 'TemperaturasController@maxTemperatura')->name('api.temperaturas.max.temperatura');
    Route::get('/temperaturas/min/temperatura', 'TemperaturasController@minTemperatura')->name('api.temperaturas.min.temperatura');
    Route::get('/temperaturas/max/humidade', 'TemperaturasController@maxHumidade')->name('api.temperaturas.max.humidade');
    Route::get('/temperaturas/min/humidade', 'TemperaturasController@minHumidade')->name('api.temperaturas.min.humidade');
    Route::get('/temperaturas/chart', 'TemperaturasController@chart')->name('api.temperaturas.chart');
    Route::get('/temperaturas/chart2', 'TemperaturasController@chart2')->name('api.temperaturas.chart2');
    
    Route::get('/data', 'DataHoraContoller@data')->name('api.data-hora.data');
    Route::get('/hora', 'DataHoraContoller@hora')->name('api.data-hora.hora');
    Route::get('/data-hora', 'DataHoraContoller@dataHora')->name('api.data-hora.data-hora');
    Route::get('/time-zones', 'DataHoraContoller@timeZones')->name('api.data-hora.time-zones');
    
    Route::get('/iot/ota/versao/{device}', 'OtaVersaoController@otaVersion')->name('api.iot.ota.version');


    /**
     * Deprected
     */
    Route::get('/usuarios', 'UsuariosController@index')->name('api.usuarios.index');
    Route::get('/usuarios/{usuario}/find', 'UsuariosController@find')->name('api.usuarios.find');
    Route::post('/usuarios/create', 'UsuariosController@create')->name('api.usuarios.create');
    Route::put('/usuarios/{usuario}/update', 'UsuariosController@update')->name('api.usuarios.update');
    Route::delete('/usuarios/{usuario}/destroy', 'UsuariosController@destroy')->name('api.usuarios.destroy');

});