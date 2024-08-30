<?php

namespace Modules\Product\Config;


use Modules\Product\Entities\Product;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Product',
            'en_plural_name' => 'Product',
            'fa_name' => 'محصولات',
            'fa_plural_name' => 'محصولات',
            'prefix' => 'Product',
            'icon' => 'icon-box',
            'menus' => [
                'ProductCategory.create' => ['label' => 'ثبت دسته بندی', 'permission' => 'Product.create', 'icon' => ''],
                'ProductCategory.index' => ['label' => 'لیست دسته بندی', 'permission' => 'Product.index', 'icon' => ''],
                'ProductBrand.create' => ['label' => 'ثبت برند', 'permission' => 'Product.create', 'icon' => ''],
                'ProductBrand.index' => ['label' => 'لیست برند', 'permission' => 'Product.index', 'icon' => ''],
                'Product.index' => ['label' => 'لیست محصولات', 'permission' => 'Product.index', 'icon' => ''],
                'ProductSetting.index' => ['label' => 'تنظیمات فروش', 'permission' => 'Product.index', 'icon' => ''],
                'OrderProduct.index' => ['label' => 'لیست فروش', 'permission' => 'Product.index', 'icon' => ''],
                'CertificatePharmacy.index' => ['label' => 'فعال سازی داروخانه', 'permission' => 'Product.index', 'icon' => ''],


                'Pharmacy.index' => ['label' => 'لیست داروخانه', 'permission' => 'Product.index', 'icon' => ''],
                'Pharmacy.create' => ['label' => 'ثبت داروخانه', 'permission' => 'Product.create', 'icon' => ''],


            ],
            'permissions' => [
                'Product' => [
                    'label' => 'محصولات',
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
        (new Product())->delete();
    }
}
