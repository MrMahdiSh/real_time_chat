<?php

namespace Modules\Patient\Config;


use Modules\Patient\Entities\Patient;

use PhpParser\Comment\Doc;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Patient',
            'en_plural_name' => 'Patient',
            'fa_name' => 'بیمار',
            'fa_plural_name' => 'بیمار',
            'prefix' => 'Patient',
            'icon' => 'icon-disc',
            'menus' => [
                'Patient.index' => ['label' => 'لیست بیماران', 'permission' => 'Patient.index', 'icon' => ''],
            ],
            'permissions' => [
                'Patient' => [
                    'label' => 'بیمار',
                    'perms' => ['edit', 'index', 'destroy']
                ]
            ]
        ];
    }

    public function customSetup()
    {

    }

    public function customRemove()
    {
        (new Patient())->delete();
    }
}
