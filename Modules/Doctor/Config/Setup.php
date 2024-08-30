<?php

namespace Modules\Doctor\Config;


use Modules\Doctor\Entities\Doctor;
use Modules\Doctor\Entities\DoctorAccount;
use Modules\Doctor\Entities\DoctorAchivment;
use Modules\Doctor\Entities\DoctorContact;
use Modules\Doctor\Entities\DoctorEducation;
use Modules\Doctor\Entities\DoctorExpience;
use Modules\Doctor\Entities\DoctorService;
use PhpParser\Comment\Doc;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Doctor',
            'en_plural_name' => 'Doctor',
            'fa_name' => 'دکتر',
            'fa_plural_name' => 'دکتر',
            'prefix' => 'Doctor',
            'icon' => 'icon-disc',
            'menus' => [
                'Doctor.index' => ['label' => 'لیست دکتر', 'permission' => 'Doctor.index', 'icon' => ''],
                'DoctorComment.index' => ['label' => 'نظرات', 'permission' => 'Doctor.index', 'icon' => ''],
            ],
            'permissions' => [
                'Doctor' => [
                    'label' => 'دکتر',
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
        (new Doctor())->delete();
        (new DoctorAccount())->delete();
        (new DoctorAchivment())->delete();
        (new DoctorContact())->delete();
        (new DoctorEducation())->delete();
        (new DoctorService())->delete();
        (new DoctorExpience())->delete();
    }
}
