<?php

namespace Modules\User\Config;

use App\User;
use App\Menu;
use Spatie\Permission\Models\Role;

class Setup
{
    public $config = [];

    public function __construct()
    {
        $super_user = Role::updateOrCreate([
            'name' => 'super_admin',
        ], [
            'guard_name' => 'web',
            'display_name' => 'SuperAdmin'
        ]);

        $super_user = Role::updateOrCreate([
            'name' => 'user',
        ], [
            'guard_name' => 'web',
            'display_name' => 'Users '
        ]);


        $this->config = [
            'en_name' => 'Admins',
            'en_plural_name' => 'Admins',
            'fa_name' => 'کاربر',
            'fa_plural_name' => 'کاربران',
            'prefix' => 'Admins',
            'icon' => 'icon-user',
            'menus' => [
                'Admins.create' => ['label' => 'ثبت کاربر', 'permission' => 'Admins.create', 'icon' => ''],
                'Admins.index' => ['label' => 'کاربران پنل', 'permission' => 'Admins.index', 'icon' => ''],
                'Roles.create' => ['label' => 'ثبت نقش', 'permission' => 'Roles.create', 'icon' => ''],
                'Roles.index' => ['label' => 'لیست نقش ها', 'permission' => 'Roles.index', 'icon' => ''],

                'UserSite.index' => ['label' => 'کاربران سایت', 'permission' => 'Admins.index', 'icon' => ''],
            ],
            'permissions' => [
                'Admins' => [
                    'label' => 'کاربر',
                    'perms' => ['create', 'edit', 'index', 'destroy']
                ],
                'Roles' => [
                    'label' => 'نقش',
                    'perms' => ['create', 'edit', 'index', 'destroy']
                ]
            ]
        ];
    }

    public function customSetup()
    {
        $user = User::updateOrCreate([
            'email' => 'admin@looxdata.ir'
        ], [
            'name' => 'admin',
            'family' => 'panel',
            'username' => 'admin',
            'mobile' => '09000000000',
            'email' => 'admin@looxdata.ir',
            'password' => \Illuminate\Support\Facades\Hash::make(1234)
        ]);


        $user->syncRoles(['super_admin']);
    }

    public function customRemove()
    {
        User::where(['email' => 'admin@looxdata.ir'])->delete();
        Role::where(['name' => 'super_admin'])->delete();
    }
}
