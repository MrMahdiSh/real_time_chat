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

Route::get('/', 'BlogController@index')->name('index');
Route::get('team', 'BlogController@team')->name('team');
Route::get('blogs', 'BlogController@blogs')->name('blogs');
Route::get('products', 'BlogController@products')->name('products');
Route::get('services', 'BlogController@services')->name('services');

Route::get('service/{id}/{title}', 'BlogController@service_detail')->name('service.detail');


Route::get('product/{id}/{title}', 'BlogController@product_detail')->name('product.detail');


Route::get('blog/{id}/{title}', 'BlogController@single_blog')->name('blog');
Route::get('blog/search', 'BlogController@search_blog')->name('blog.search');

Route::post('blog/comment', 'BlogController@comment_store')->name('blog.comment');
Route::get('profile/result_pay', 'PatientBlogController@result_pay')->name('result.payment');


Route::get('doctor/search', 'BlogController@doctor_search_result')->name('doctor.search');
Route::get('doctor/search/result', 'BlogController@doctor_search_result')->name('doctor.search.result');
Route::get('about_us', 'BlogController@about_us')->name('about_us');
Route::get('contact_us', 'BlogController@contact_us')->name('contact_us');
Route::post('contact_us', 'BlogController@contact_us_post')->name('contact_us.post');
Route::get('faq', 'BlogController@faq')->name('faq');
Route::get('policy', 'BlogController@policy')->name('policy');
Route::get('privacy', 'BlogController@privacy')->name('privacy');
Route::get('page/{title}/{id}', 'BlogController@page')->name('page');


Route::prefix('doctor')->group(function () {
    Route::get('register', 'BlogController@doctor_register')->name('doctor.register');
    Route::post('register', 'BlogController@doctor_register_post')->name('doctor.register.post');
    Route::get('login', 'BlogController@doctor_login')->name('doctor.login');
    Route::post('login', 'BlogController@doctor_login_post')->name('doctor.login.post');

});

Route::prefix('doctor')->middleware('auth:doctor')->group(function () {

    #region Service Doctor
    Route::get('service/add', 'DoctorBlogController@service_add')->name('doctor.service');
    Route::post('service/add', 'DoctorBlogController@service_add_post')->name('doctor.service.post');
    Route::get('service/orders', 'DoctorBlogController@service_orders')->name('doctor.service.orders');
    Route::get('service/edit/{id}', 'DoctorBlogController@service_edit')->name('doctor.service.edit');
    Route::put('service/edit/{id}', 'DoctorBlogController@service_update')->name('doctor.service.update');
    Route::get('service/list', 'DoctorBlogController@service_list')->name('doctor.service.list');


    Route::get('avatar', 'DoctorBlogController@avatar')->name('doctor.avatar');
    Route::post('avatar', 'DoctorBlogController@avatar_post')->name('doctor.avatar.post');
    Route::get('dashboard', 'DoctorBlogController@dashboard')->name('doctor.dashboard');
    Route::get('logout', 'DoctorBlogController@doctor_logout')->name('doctor.logout');
    Route::get('profile', 'DoctorBlogController@profile')->name('doctor.profile');
    Route::post('profile', 'DoctorBlogController@profile_post')->name('doctor.profile.post');
    Route::get('profile/change_password', 'DoctorBlogController@change_password')->name('doctor.profile.change_password');
    Route::post('profile/change_password', 'DoctorBlogController@change_password_post')->name('doctor.profile.change_password.post');
    Route::get('schedule_time', 'DoctorBlogController@schedule_time')->name('doctor.schedule_time');
    Route::post('schedule_time', 'DoctorBlogController@schedule_time_post')->name('doctor.schedule_time.post');
    Route::get('schedule_time/delete/{id}', 'DoctorBlogController@schedule_time_delete')->name('doctor.schedule_time.delete');
    Route::get('reserved_time', 'DoctorBlogController@reserved_time')->name('doctor.reserved_time');
    Route::get('reserved_time/reserve', 'DoctorBlogController@reserved_time_reserve')->name('doctor.reserved_time.reserve');

    Route::get('transactions', 'DoctorBlogController@transactions')->name('doctor.transactions');
    Route::get('orders', 'DoctorBlogController@orders')->name('doctor.orders');
    Route::get('order/status/{id}', 'DoctorBlogController@order_status')->name('doctor.order.status');

    Route::get('setting', 'DoctorBlogController@setting')->name('doctor.setting');
    Route::post('setting', 'DoctorBlogController@setting_post')->name('doctor.setting.post');

    Route::get('profile/factor/{id}', 'DoctorBlogController@factor')->name('doctor.profile.factor');
    Route::get('appointments', 'DoctorBlogController@appointments')->name('doctor.appointments');
    Route::get('my-patients', 'DoctorBlogController@my_patients')->name('doctor.patients');


    Route::get('articles', 'DoctorBlogController@articles')->name('doctor.articles');
    Route::post('article', 'DoctorBlogController@article_post')->name('doctor.article.post');
    Route::put('article/update/{id}', 'DoctorBlogController@article_update')->name('doctor.article.update');
    Route::get('article', 'DoctorBlogController@article')->name('doctor.article');
    Route::get('article/{id}/edit', 'DoctorBlogController@article_edit')->name('doctor.article.edit');
    Route::get('article/{id}/delete', 'DoctorBlogController@article_delete')->name('doctor.article.delete');

    Route::get('article/{id}/comments', 'DoctorBlogController@article_comments')->name('doctor.article.comments');
    Route::put('article/update_comments/{blog_id}/{id}', 'DoctorBlogController@article_update_comments')->name('doctor.comment.update');


    Route::get('account', 'DoctorBlogController@account')->name('doctor.account');
    Route::post('account', 'DoctorBlogController@account_post')->name('doctor.account.post');
    Route::get('my-patients', 'DoctorBlogController@my_patients')->name('doctor.patients');
    Route::get('payment_request', 'DoctorBlogController@payment_request')->name('doctor.payment.request');


    Route::get('patient_profile/{id}', 'DoctorBlogController@patient_profile')->name('doctor.patient.profile');


    Route::get('chats', 'DoctorBlogController@chats')->name('doctor.chats');
    Route::get('tickets', 'DoctorBlogController@tickets')->name('doctor.tickets');

    Route::get('side_bar_chat_view', 'DoctorBlogController@side_bar_chat_view')->name('doctor.chat.side_bar');
    Route::get('content_chat_view', 'DoctorBlogController@content_chat_view')->name('doctor.chat.content');


    Route::get('side_bar_ticket_view', 'DoctorBlogController@side_bar_ticket_view')->name('doctor.ticket.side_bar');
    Route::get('content_ticket_view', 'DoctorBlogController@content_ticket_view')->name('doctor.ticket.content');


    Route::post('chat/send', 'DoctorBlogController@chat_post')->name('doctor.chat.post');
    Route::post('tickets/send', 'DoctorBlogController@tickets_post')->name('doctor.ticket.post');


    Route::get('certificate/product', 'DoctorBlogController@certificate_product')->name('doctor.certificate.product');
    Route::post('certificate/product', 'DoctorBlogController@certificate_product_post')->name('doctor.certificate.product.post');

    Route::get('product', 'DoctorBlogController@product')->name('doctor.product');
    Route::get('product/list', 'DoctorBlogController@product_list')->name('doctor.product.list');
    Route::post('product', 'DoctorBlogController@product_post')->name('doctor.product.post');
    Route::get('product/{id}/edit', 'DoctorBlogController@product_edit')->name('doctor.product.edit');
    Route::put('product/{id}/update', 'DoctorBlogController@product_update')->name('doctor.product.update');

});


Route::prefix('patient')->group(function () {
    Route::get('register', 'BlogController@patient_register')->name('patient.register');
    Route::post('register', 'BlogController@patient_register_post')->name('patient.register.post');
    Route::get('login', 'BlogController@patient_login')->name('patient.login');
    Route::post('login', 'BlogController@patient_login_post')->name('patient.login.post');
});


Route::prefix('patient')->middleware('auth:patient')->group(function () {
    Route::get('dashboard', 'PatientBlogController@dashboard')->name('patient.dashboard');
    Route::get('logout', 'PatientBlogController@patient_logout')->name('patient.logout');
    Route::get('profile', 'PatientBlogController@profile')->name('patient.profile');
    Route::get('favorite', 'PatientBlogController@favorite')->name('patient.favorite');
    Route::post('profile', 'PatientBlogController@profile_post')->name('patient.profile.post');
    Route::get('profile/change_password', 'PatientBlogController@change_password')->name('patient.profile.change_password');
    Route::post('profile/change_password', 'PatientBlogController@change_password_post')->name('patient.profile.change_password.post');

    Route::get('/profile/period_reminder', 'PatientBlogController@perdiodReminder')->name('patient.profile.perdiodReminder');
    Route::post('/profile/period_reminder/update_info', 'PatientBlogController@perdiodReminderUpdateInfo')->name('patient.profile.perdiodReminderUpdateInfo');



    Route::get('profile/factor/{id}', 'PatientBlogController@factor')->name('patient.profile.factor');
    Route::get('profile/factor/{id}/service', 'PatientBlogController@factor_service')->name('patient.profile.service.factor');


    Route::get('profile/payment/{id}', 'PatientBlogController@payment')->name('patient.payment.factor');
    Route::get('profile/payment/{id}/service', 'PatientBlogController@payment_service')->name('patient.service.payment.factor');
    Route::get('profile/payment/{id}/wallet/service', 'PatientBlogController@payment_service_wallet')->name('patient.service.payment.wallet');


    Route::get('profile/payment/{id}/wallet', 'PatientBlogController@payment_wallet')->name('patient.payment.wallet');


    Route::get('profile/reserve/destroy/{id}', 'PatientBlogController@reserve_destroy')->name('patient.reserve.destroy');
    Route::get('profile/reserve_service/destroy/{id}', 'PatientBlogController@reserve_service_destroy')->name('patient.reserve.service.destroy');


    Route::get('reserves', 'PatientBlogController@reserves')->name('patient.reserves');


    Route::get('favorite/product/', 'PatientBlogController@favorite_product')->name('patient.favorite.product');


    Route::get('favorite/add/{id}', 'PatientBlogController@favorite_store')->name('favorite.store');
    Route::get('favorite/remove/{id}', 'PatientBlogController@favorite_destroy')->name('favorite.destroy');
    Route::get('chat/{id}', 'PatientBlogController@chat_store')->name('patient.chat.store');
    Route::post('chat/send', 'PatientBlogController@chat_post')->name('patient.chat.post');

    Route::get('chats', 'PatientBlogController@chats')->name('patient.chats');

    Route::get('side_bar_chat_view', 'PatientBlogController@side_bar_chat_view')->name('patient.chat.side_bar');
    Route::get('content_chat_view', 'PatientBlogController@content_chat_view')->name('patient.chat.content');
    Route::get('wallet', 'PatientBlogController@wallet')->name('patient.wallet');
    Route::get('charge', 'PatientBlogController@wallet_charge')->name('patient.wallet.charge');
    Route::get('transaction', 'PatientBlogController@transaction')->name('patient.transaction');
    Route::get('reviews', 'PatientBlogController@reviews')->name('patient.reviews');
    Route::get('factors', 'PatientBlogController@factors')->name('patient.factors');
    Route::get('factors/pay', 'PatientBlogController@factors_pay')->name('patient.factors.pay');


    Route::get('orders', 'PatientBlogController@orders')->name('patient.orders');
    Route::get('orders/service', 'PatientBlogController@orders_service')->name('patient.service.orders');


    Route::get('addToCard', 'CardController@addToCard')->name('card.add');
    Route::get('RemoveFromCard', 'CardController@RemoveFromCard')->name('card.remove');
    Route::get('RemoveItemCard', 'CardController@RemoveItemCard')->name('card.RemoveItemCard');
    Route::get('card/checkout', 'CardController@card_checkout')->name('card.checkout');
    Route::get('card/checkout/pay', 'CardController@card_checkout_pay')->name('card.checkout.pay');
    Route::get('card/checkout/pay/wallet', 'CardController@card_checkout_wallet')->name('card.checkout.wallet');
    Route::post('card/checkout/pay', 'CardController@payment_card')->name('card.pay');
    Route::get('product/favorite/{id}', 'PatientBlogController@add_product_favorite')->name('product.favorite');
    Route::get('product/favorite/{id}/remove', 'PatientBlogController@remove_product_favorite')->name('product.favorite.remove');

});


Route::prefix('doctor')->group(function () {
    Route::get('doctor_profile', 'DoctorBlogController@doctor_profile')->name('doctor_profile');
    Route::post('doctor_feedback', 'DoctorBlogController@feedback_profile')->name('doctor.feedback');
    Route::post('service_feedback', 'DoctorBlogController@service_feedback')->name('service.feedback');


    Route::get('reserved', 'DoctorBlogController@reserved')->name('doctor_reserved');
    Route::get('service/reserved', 'DoctorBlogController@doctor_service_reserved')->name('doctor_service_reserved');


    Route::get('reserved_doctor_schedule', 'DoctorBlogController@reserved_doctor_schedule')->name('reserved_doctor_schedule');
    Route::get('reserved_service_doctor_schedule', 'DoctorBlogController@reserved_service_doctor_schedule')->name('reserved_service_doctor_schedule');
});
