<?php


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth', 'web')->group(function () {
    Route::resource('Page', 'PageController');
    Route::get('Page/status/{id}', 'PageController@status')->name('Page.status');
});

