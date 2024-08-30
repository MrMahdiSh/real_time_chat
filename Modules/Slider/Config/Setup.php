<?php

namespace Modules\Slider\Config;


use Modules\Slider\Entities\Slider;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Slider',
            'en_plural_name' => 'Slider',
            'fa_name' => 'اسلایدر',
            'fa_plural_name' => 'اسلایدر',
            'prefix' => 'Slider',
            'icon' => 'icon-image',
            'menus' => [
                'Slider.create' => ['label' => 'ثبت اسلایدر', 'permission' => 'Slider.create', 'icon' => ''],
                'Slider.index' => ['label' => 'لیست اسلایدر', 'permission' => 'Slider.index', 'icon' => ''],
            ],
            'permissions' => [
                'Slider' => [
                    'label' => 'اسلایدر',
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
        (new Slider())->delete();
    }
}
