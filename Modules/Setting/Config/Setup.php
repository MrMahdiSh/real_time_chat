<?php

namespace Modules\Setting\Config;


use Modules\Setting\Entities\Setting;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Setting',
            'en_plural_name' => 'Setting',
            'fa_name' => 'تنظیمات',
            'fa_plural_name' => 'تنظیمات',
            'prefix' => 'Setting',
            'icon' => 'icon-settings',
            'menus' => [
                'ContactUs.index' => ['label' => 'تماس باما', 'permission' => 'Setting.index', 'icon' => ''],
                'ContactUs.create' => ['label' => 'تنظیمات تماس باما', 'permission' => 'Setting.index', 'icon' => ''],

                'Setting.index' => ['label' => 'تنظیمات اصلی', 'permission' => 'Setting.index', 'icon' => ''],

                'SettingIndex.index' => ['label' => 'تنظیمات صفحه اول', 'permission' => 'Setting.index', 'icon' => ''],
            ],
            'permissions' => [
                'Setting' => [
                    'label' => 'تنظیمات',
                    'perms' => ['index', 'destroy']
                ]
            ]
        ];
    }

    public function customSetup()
    {

    }

    public function customRemove()
    {
        (new Setting())->delete();
    }
}
