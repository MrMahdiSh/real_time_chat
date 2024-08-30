<?php

namespace Modules\State\Config;


use Modules\State\Entities\City;
use Modules\State\Entities\State;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'State',
            'en_plural_name' => 'State',
            'fa_name' => 'شهر/استان',
            'fa_plural_name' => 'شهر/استان',
            'prefix' => 'State',
            'icon' => 'icon-list',
            'menus' => [
                'State.create' => ['label' => 'ثبت استان/شهر', 'permission' => 'State.create', 'icon' => ''],
                'State.index' => ['label' => 'لیست استان/شهر', 'permission' => 'State.index', 'icon' => ''],
            ],
            'permissions' => [
                'State' => [
                    'label' => 'شهر/استان',
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
        (new State())->delete();
        (new City())->delete();
    }
}
