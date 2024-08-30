<?php

namespace Modules\News\Config;


use Modules\News\Entities\News;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'News',
            'en_plural_name' => 'News',
            'fa_name' => 'پیشنهادات،اخبار',
            'fa_plural_name' => 'پیشنهادات،اخبار',
            'prefix' => 'News',
            'icon' => 'icon-file-text',
            'menus' => [
                'News.create' => ['label' => 'ثبت خبر', 'permission' => 'News.create', 'icon' => ''],
                'News.index' => ['label' => 'لیست اخبار', 'permission' => 'News.index', 'icon' => ''],
            ],
            'permissions' => [
                'News' => [
                    'label' => 'پیشنهادات،اخبار',
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
        (new News())->delete();
    }
}
