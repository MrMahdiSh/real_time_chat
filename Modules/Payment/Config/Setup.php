<?php

namespace Modules\Payment\Config;

use Modules\Payment\Entities\TransAction;
use Modules\Payment\Entities\PaymentSetting;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Payment',
            'en_plural_name' => 'Payment',
            'fa_name' => 'درگاه پرداخت',
            'fa_plural_name' => 'درگاه پرداخت',
            'prefix' => 'Payment',
            'icon' => 'icon-credit-card',
            'menus' => [
                'PaymentSetting.index' => ['label' => 'تنظیمات پرداخت', 'permission' => 'Payment.index', 'icon' => ''],
                'TransActions.index' => ['label' => 'تراکنشات', 'permission' => 'Payment.index', 'icon' => ''],
                'Payment.index' => ['label' => 'درخواست های پرداخت', 'permission' => 'Payment.index', 'icon' => ''],
//                'Orders.index' => ['label' => 'سفارشات', 'permission' => 'Payment.index', 'icon' => ''],
            ],
            'permissions' => [
                'Payment' => [
                    'label' => 'درگاه پرداخت',
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
        (new TransAction())->delete();
        (new PaymentSetting())->delete();

    }
}
