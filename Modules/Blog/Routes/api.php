<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('get_cities/{id}', 'ApiBlogController@get_cities')->name('api.get_cities');
Route::get('setFav/{id}', 'ApiBlogController@setFav')->name('api.setFav');

Route::get('city_search', 'ApiBlogController@city_search')->name('api.city_search');
