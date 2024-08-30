<?php

namespace Modules\Clinic\Config;


use Modules\Clinic\Entities\City;
use Modules\Clinic\Entities\Clinic;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Clinic',
            'en_plural_name' => 'Clinic',
            'fa_name' => 'کلینیک',
            'fa_plural_name' => 'کلینیک',
            'prefix' => 'Clinic',
            'icon' => 'icon-disc',
            'menus' => [
                'Clinic.create' => ['label' => 'ثبت کلینیک', 'permission' => 'Clinic.create', 'icon' => ''],
                'Clinic.index' => ['label' => 'لیست کلینیک', 'permission' => 'Clinic.index', 'icon' => ''],
            ],
            'permissions' => [
                'Clinic' => [
                    'label' => 'کلینیک',
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
        (new Clinic())->delete();
    }
}
