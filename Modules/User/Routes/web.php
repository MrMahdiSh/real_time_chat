<?php


use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'web')->prefix('admin')->group(function () {
    Route::resource('Admins', 'AdminController');
    Route::resource('Roles', 'RoleController');



});
