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
    Route::put('/componete/sinal/update', 'ComponentesController@updateSinal')->name('api.componente.sinal.update');
});