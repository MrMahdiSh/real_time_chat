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

Route::prefix('admin')->middleware('web','auth')->group(function() {
    Route::resource('Article', 'ArticleController');
    Route::resource('ArticleTag', 'ArticleTagController');
    Route::resource('ArticleCategory', 'ArticleCategoryController');
    Route::resource('ArticleComment', 'ArticleCommentController');

    Route::get('ArticleTag/status/{id}', 'ArticleTagController@status')->name('ArticleTag.status');
    Route::get('ArticleCategory/status/{id}', 'ArticleCategoryController@status')->name('ArticleCategory.status');
    Route::get('Article/status/{id}', 'ArticleController@status')->name('Article.status');
    Route::get('Articles/status', 'ArticleController@articles_status')->name('articles.status');
    Route::get('ArticleComment/status/{id}', 'ArticleCommentController@status')->name('ArticleComment.status');


    Route::get('ArticleComment/comment/all', 'ArticleCommentController@index_comments')->name('article.comments');

});
