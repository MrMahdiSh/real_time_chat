<?php

namespace Modules\Service\Config;


use Modules\Service\Entities\ServiceCategory;
use Modules\Service\Entities\ServiceModel;
use Modules\Service\Entities\ServiceRate;
use Modules\Service\Entities\ServiceReserve;
use Modules\Service\Entities\ServiceSetting;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Service',
            'en_plural_name' => 'Service',
            'fa_name' => 'خدمات',
            'fa_plural_name' => 'خدمات',
            'prefix' => 'Service',
            'icon' => 'icon-box',
            'menus' => [
                'ServiceCategory.create' => ['label' => 'ثبت دسته بندی', 'permission' => 'Service.create', 'icon' => ''],
                'ServiceCategory.index' => ['label' => 'لیست دسته بندی', 'permission' => 'Service.index', 'icon' => ''],

                'ServiceRate.index' => ['label' => 'نظرات', 'permission' => 'Service.index', 'icon' => ''],

                'ServiceModel.index' => ['label' => 'خدمات', 'permission' => 'Service.index', 'icon' => ''],

                'ServiceOrder.index' => ['label' => 'سفارشات', 'permission' => 'Service.index', 'icon' => ''],

                'ServiceSetting.index' => ['label' => 'تنظیمات', 'permission' => 'Service.index', 'icon' => ''],

            ],
            'permissions' => [
                'Service' => [
                    'label' => 'خدمات',
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
        (new ServiceReserve())->delete();
        (new ServiceCategory())->delete();
        (new ServiceRate())->delete();
        (new ServiceModel())->delete();
        (new ServiceSetting())->delete();
    }
}
