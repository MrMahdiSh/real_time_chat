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
    Route::resource('ProductBrand', 'ProductBrandController');
    Route::resource('ProductCategory', 'ProductCategoryController');
    Route::resource('Product', 'ProductController');
    Route::resource('ProductSetting', 'ProductSettingController');
    Route::resource('OrderProduct', 'OrderProductController');
    Route::resource('CertificatePharmacy', 'CertificatePharmacyController');
    Route::resource('Pharmacy', 'PharmacyController');

    Route::get('OrderProduct/{id}/confirm', 'OrderProductController@confirm')->name('ProductOrder.confirm');

    Route::get('pharmacy/status/{id}', 'PharmacyController@status')->name('pharmacy.status');


});
