<?php

namespace Modules\Faq\Config;


use Modules\Faq\Entities\Faq;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Faq',
            'en_plural_name' => 'Faq',
            'fa_name' => 'سوالات متداول',
            'fa_plural_name' => 'سوالات متداول',
            'prefix' => 'Faq',
            'icon' => 'icon-help-circle',
            'menus' => [
                'Faq.create' => ['label' => 'ثبت سوال', 'permission' => 'Faq.create', 'icon' => ''],
                'Faq.index' => ['label' => 'لیست سوالات ', 'permission' => 'Faq.index', 'icon' => ''],
            ],
            'permissions' => [
                'Faq' => [
                    'label' => 'سوالات متداول',
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
        (new Faq())->delete();
    }
}
