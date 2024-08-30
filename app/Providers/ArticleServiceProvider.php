<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleTag;
use Illuminate\Support\Facades\View;

class ArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('blog::partials.article_side_bar', function ($view) {
            $view->with([
                'posts' => Article::where('status', '1')->latest()->take(5)->get(),
                'category' => ArticleCategory::where('status', '1')->get(),
                'tags' => ArticleTag::where('status', '1')->get()]);
        });
    }
}
