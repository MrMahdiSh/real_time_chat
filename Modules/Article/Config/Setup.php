<?php

namespace Modules\Article\Config;


use Modules\Article\Entities\Article;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Article',
            'en_plural_name' => 'Article',
            'fa_name' => 'مقالات',
            'fa_plural_name' => 'مقالات',
            'prefix' => 'Article',
            'icon' => 'icon-feather',
            'menus' => [
                'Article.create' => ['label' => 'ثبت مقاله', 'permission' => 'Article.create', 'icon' => ''],
                'ArticleTag.create' => ['label' => 'ثبت تگ', 'permission' => 'Article.create', 'icon' => ''],
                'ArticleCategory.create' => ['label' => 'ثبت دسته', 'permission' => 'Article.create', 'icon' => ''],

                'Article.index' => ['label' => 'لیست مقالات', 'permission' => 'Article.index', 'icon' => ''],
                'ArticleCategory.index' => ['label' => 'لیست دسته ها', 'permission' => 'Article.index', 'icon' => ''],
                'ArticleTag.index' => ['label' => 'لیست تگ ها', 'permission' => 'Article.index', 'icon' => ''],
            ],
            'permissions' => [
                'Article' => [
                    'label' => 'مقالات',
                    'perms' => ['create', 'edit', 'index', 'destroy']
                ]
            ]
        ];
    }

    public function customSetup()
    {

    }

    public function customRemove()
    {
        (new Article())->delete();
    }
}
