<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Modules\Setting\Entities\Setting;
use Modules\User\Http\Controllers\AdminController;

Route::get('backToAdminSession', [AdminController::class, 'backToAdminSession'])->name('backToAdminSession')->middleware('throttle:15,1');
Route::get('/{id}/doSignIn', [AdminController::class, 'doSignIn'])->name('doSignIn');

Route::prefix('admin')->group(function () {


    Route::get('set_zlocal/{lang}', 'UserController@setLocale')->name('setLocale');
//    Route::get('', 'UserController@setLocale')->name('setLocale');

    Route::get('login', 'AuthController@login')->name('admin.login');
    Route::get('login', 'AuthController@login')->name('login');
    Route::post('login', 'AuthController@login_post')->name('admin.login.post');


    Route::middleware('auth', 'web')->group(function () {


        Route::get('logout', 'AuthController@logout')->name('admin.logout');
        Route::get('log/clear', 'AuthController@log_clear')->name('log_clear');


        Route::get('dashboard', 'AuthController@dashboard')->name('dashboard');
        Route::resource('profile', 'ProfileController');
        Route::resource('admins', 'AuthController@dashboard');
        Route::resource('roles', 'AuthController@dashboard');
    });

});

Route::get('media/{size?}/{filename?}', 'MediaController@show')->name('show_img');
Route::post('remove_media', [
    'as' => 'remove_media',
    'uses' => 'MediaController@destroy'
]);

Route::get('/link', 'AuthController@link');

Route::get("clear", 'AuthController@clear');
//Route::get("mails", function () {
//    $setting = Setting::with('logo')->first();
//    $details = [];
//    $details['logo'] = $setting->logo;
//    $details['title'] = 'عنوان من';
//    $details['description'] = 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.';
//
//});


