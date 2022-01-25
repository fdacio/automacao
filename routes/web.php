<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('componentes', 'ComponentesController');
Route::get('componentes/{componente}', 'ComponentesController@destroy')->name('componentes.destroy');
Route::resource('informacoes', 'InformacoesController')->parameters(['informacoes' => 'informacao']);
Route::get('infomacoes/destroy/{informacao}', 'InformacoesController@destroy')->name('informacoes.destroy');
Route::get('iot', 'IotController@index')->name('iot.index');
Route::get('sensores', 'SensoresController@index')->name('sensores.index');