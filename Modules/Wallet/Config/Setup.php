<?php

namespace Modules\Wallet\Config;


use Modules\Wallet\Entities\Wallet;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Wallet',
            'en_plural_name' => 'Wallet',
            'fa_name' => 'تیم ما',
            'fa_plural_name' => 'تیم ما',
            'prefix' => 'Wallet',
            'icon' => 'icon-users',
            'menus' => [
               // 'Wallet.create' => ['label' => 'ثبت نفر', 'permission' => 'Wallet.create', 'icon' => ''],
              //  'Wallet.index' => ['label' => 'لیست نفرات', 'permission' => 'Wallet.index', 'icon' => ''],
            ],
            'permissions' => [
//                'Wallet' => [
//                    'label' => 'تیم ما',
//                    'perms' => ['create', 'edit', 'index', 'destroy']
//                ]
            ]
        ];
    }

    public function customSetup()
    {

    }

    public function customRemove()
    {
        (new Wallet())->delete();
    }
}
