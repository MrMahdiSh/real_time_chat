<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleTag;
use Illuminate\Support\Facades\View;
use Modules\Doctor\Entities\Chat;
use Modules\Ticket\Entities\Ticket;

class DoctorSideBarServiceProvider extends ServiceProvider
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
        View::composer('blog::partials.doctor_sidebar', function ($view) {
            $view->with([
                'unseen_chat' => Chat::where('doc_id', Auth::guard('doctor')->id())->where('seen', 0)->get()->count(),
                'unseen_ticket' => Ticket::where('doc_id', Auth::guard('doctor')->id())->where('seen', 1)->get()->count()
            ]);
        });
    }
}
