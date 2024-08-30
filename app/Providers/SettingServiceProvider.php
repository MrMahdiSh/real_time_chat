<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleTag;
use Illuminate\Support\Facades\View;
use Modules\Link\Entities\Link;
use Modules\Page\Entities\Page;
use Modules\Product\Entities\ProductSetting;
use Modules\Setting\Entities\Setting;

class SettingServiceProvider extends ServiceProvider
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
        View::composer('blog::layouts.master_index', function ($view) {
            $view->with([
                'setting' => Setting::first(),
                'pages' => Page::where('status', '1')->get(),
                'links' => Link::get(),
                'product_setting' => ProductSetting::first(),
            ]);
        });
    }
}
