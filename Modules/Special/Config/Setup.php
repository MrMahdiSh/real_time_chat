<?php

namespace Modules\Special\Config;


use Modules\Special\Entities\Special;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Special',
            'en_plural_name' => 'Special',
            'fa_name' => 'ویژگی',
            'fa_plural_name' => 'ویژگی',
            'prefix' => 'Special',
            'icon' => 'icon-disc',
            'menus' => [
                'Special.create' => ['label' => 'ثبت ویژگی', 'permission' => 'Special.create', 'icon' => ''],
                'Special.index' => ['label' => 'لیست ویژگی', 'permission' => 'Special.index', 'icon' => ''],
            ],
            'permissions' => [
                'Special' => [
                    'label' => 'ویژگی',
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
        (new Special())->delete();
    }
}
