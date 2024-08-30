<?php

namespace Modules\Category\Config;


use Modules\Category\Entities\Category;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Category',
            'en_plural_name' => 'Category',
            'fa_name' => 'تخصص',
            'fa_plural_name' => 'تخصص',
            'prefix' => 'Category',
            'icon' => 'icon-disc',
            'menus' => [
                'Category.create' => ['label' => 'ثبت تخصص', 'permission' => 'Category.create', 'icon' => ''],
                'Category.index' => ['label' => 'لیست تخصص', 'permission' => 'Category.index', 'icon' => ''],
            ],
            'permissions' => [
                'Category' => [
                    'label' => 'تخصص',
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
        (new Category())->delete();
    }
}
