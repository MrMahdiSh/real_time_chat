<?php

namespace Modules\Team\Config;


use Modules\Team\Entities\Team;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $this->config = [
            'en_name' => 'Team',
            'en_plural_name' => 'Team',
            'fa_name' => 'تیم ما',
            'fa_plural_name' => 'تیم ما',
            'prefix' => 'Team',
            'icon' => 'icon-users',
            'menus' => [
                'Team.create' => ['label' => 'ثبت نفر', 'permission' => 'Team.create', 'icon' => ''],
                'Team.index' => ['label' => 'لیست نفرات', 'permission' => 'Team.index', 'icon' => ''],
            ],
            'permissions' => [
                'Team' => [
                    'label' => 'تیم ما',
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
        (new Team())->delete();
    }
}
