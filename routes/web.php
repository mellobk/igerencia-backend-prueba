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

Route::get('/getItems', 'egerenciaController@getItems'); 
Route::get('/getItemsById/{ic}', 'egerenciaController@getItemsById'); 
Route::get('/getItemsByYear/{year}', 'egerenciaController@getItemsByYear'); 
Route::post('/createItem', 'egerenciaController@createItem'); 
Route::post('/getSuggestionModels', 'egerenciaController@getSuggestionModels'); 
Route::put('/updateItem/{id}', 'egerenciaController@updateItem'); 
Route::delete('/destroyItem/{id}', 'egerenciaController@destroyItem');

