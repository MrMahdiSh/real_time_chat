<?php

namespace Modules\Page\Config;


use Modules\Page\Entities\Page;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Page',
            'en_plural_name' => 'Page',
            'fa_name' => 'صفحات',
            'fa_plural_name' => 'صفحات',
            'prefix' => 'Page',
            'icon' => 'icon-file-text',
            'menus' => [
                'Page.create' => ['label' => 'ثبت صفحه', 'permission' => 'Page.create', 'icon' => ''],
                'Page.index' => ['label' => 'لیست صفحات', 'permission' => 'Page.index', 'icon' => ''],
            ],
            'permissions' => [
                'Page' => [
                    'label' => 'صفحات',
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
        (new Page())->delete();
    }
}
