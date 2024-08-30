<?php


use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::resource('TransActions', 'TransActionsController');
    Route::resource('PaymentSetting', 'PaymentSettingController');
    Route::resource('Payment', 'PaymentController');
});
