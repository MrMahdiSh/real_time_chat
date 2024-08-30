<?php


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::resource('Slider', 'SliderController');
    Route::get('Slider/status/{id}', 'SliderController@status')->name('Slider.status');
});
