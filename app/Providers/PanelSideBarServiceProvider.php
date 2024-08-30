<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleTag;
use Illuminate\Support\Facades\View;
use Modules\Link\Entities\Link;
use Modules\Page\Entities\Page;
use Modules\Setting\Entities\Setting;

class PanelSideBarServiceProvider extends ServiceProvider
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
        View::composer('partials.sidebar', function ($view) {
            $view->with([
                'menus' => \App\Menu::where('parent_id', 0)
                    ->with(['sub_menus' => function ($query) {
                        return $query->with('sub_menus');
                    }])->get(),

                'setting' => Setting::first()


            ]);
        });
    }
}
