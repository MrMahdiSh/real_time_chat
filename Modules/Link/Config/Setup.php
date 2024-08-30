<?php

namespace Modules\Link\Config;


use Modules\Link\Entities\Link;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Link',
            'en_plural_name' => 'Link',
            'fa_name' => 'پیوند',
            'fa_plural_name' => 'پیوند',
            'prefix' => 'Link',
            'icon' => 'icon-external-link',
            'menus' => [
                'Link.create' => ['label' => 'ثبت پیوند', 'permission' => 'Link.create', 'icon' => ''],
                'Link.index' => ['label' => 'لیست پیوندها', 'permission' => 'Link.index', 'icon' => ''],
            ],
            'permissions' => [
                'Link' => [
                    'label' => 'پیوند',
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
        (new Link())->delete();
    }
}
