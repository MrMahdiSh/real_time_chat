<?php

namespace Modules\Advertise\Config;


use Modules\Advertise\Entities\Advertise;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Advertise',
            'en_plural_name' => 'Advertise',
            'fa_name' => 'تبلیغات',
            'fa_plural_name' => 'تبلیغات',
            'prefix' => 'Advertise',
            'icon' => 'icon-file-text',
            'menus' => [
                'AdvertisePage.create' => ['label' => 'تبلیغات صفحات', 'permission' => 'Advertise.create', 'icon' => ''],
                'AdvertisePage.index' => ['label' => ' لیست تبلیغات صفحات', 'permission' => 'Advertise.index', 'icon' => ''],
                'AdvertiseIndex.create' => ['label' => 'تبلیفات صفحه اول', 'permission' => 'Advertise.create', 'icon' => ''],
                'AdvertiseIndex.index' => ['label' => ' لیست تبلیفات صفحه اول', 'permission' => 'Advertise.index', 'icon' => ''],
            ],
            'permissions' => [
                'Advertise' => [
                    'label' => 'تبلیغات',
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
        (new Advertise())->delete();
    }
}
