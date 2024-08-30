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
    Route::resource('Doctor', 'DoctorController');
    Route::resource('DoctorComment', 'DoctorCommentController');

    Route::get('Doctor/comments/all', 'DoctorController@index_comments')->name('doctor.comments');
    Route::get('Doctor/comment/{id}/status', 'DoctorCommentController@comments_status')->name('doctor.comment.status');

    Route::get('doctorStatus/{id}', 'DoctorController@doctorStatus')->name('doctorStatus');


    Route::get('Doctor/{id}/status/certificate', 'DoctorController@status')->name('Doctor.certificate.status');

});
