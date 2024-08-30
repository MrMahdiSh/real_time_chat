<?php


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth', 'web')->group(function () {
    Route::resource('AdvertisePage', 'AdvertisePageController');
    Route::resource('AdvertiseIndex', 'AdvertiseIndexController');
});

