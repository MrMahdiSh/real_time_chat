<?php


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::resource('Link', 'LinkController');
});
