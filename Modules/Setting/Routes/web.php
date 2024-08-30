<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth', 'web')->group(function () {
    Route::resource('InstaKey', 'InstaKeyController');


    Route::resource('Insta', 'InstaController');
    Route::get('Insta/set_auth_token/{auth_token}', 'InstaController@set_auth_token')->name('set_auth_token');


    Route::resource('ContactUs', 'ContactUsController');
    Route::resource('Setting', 'SettingController');
    Route::resource('SettingIndex', 'SettingIndexController');


    Route::get('ContactUs/status/{id}', 'ContactUsController@status')->name('ContactUs.status');

});
