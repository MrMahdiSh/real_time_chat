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

Route::prefix('admin')->middleware('auth', 'web')->group(function () {
    Route::resource('ServiceCategory', 'ServiceCategoryController');
    Route::resource('ServiceRate', 'ServiceRateController');
    Route::resource('ServiceModel', 'ServiceModelController');
    Route::resource('ServiceOrder', 'ServiceOrderController');
    Route::resource('ServiceSetting', 'ServiceSettingController');


    Route::get('ServiceSetting/{id}/status/', 'ServiceCategoryController@status')->name('ServiceCategory.status');
    Route::get('ServiceRate/{id}/status/', 'ServiceRateController@status')->name('service.comment.status');
    Route::get('ServiceModel/{id}/status/', 'ServiceModelController@status')->name('ServiceModel.status');

});
