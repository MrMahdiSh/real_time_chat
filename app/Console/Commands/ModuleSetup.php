<?php

namespace App\Console\Commands;

use App\PackageName;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use App\Menu;
use App\User;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModuleSetup extends Command
{

    protected $signature = 'module:setup {module_name} {--remove}';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        $module_name = $this->argument('module_name');
        $module = "\Modules\\$module_name\Config\Setup";
        $module = new $module();

        if (!$this->option('remove'))
            $this->setup($module_name, $module);
        else
            $this->remove($module_name, $module);
    }

    public function setup($module_name, $module)
    {
        Artisan::call('module:migrate', ['module' => $module_name]);

        if (count($module->config['menus'])) {
            $parent_menu = Menu::updateOrCreate([
                'route' => strtolower($module->config['en_name'])
            ], [
                'label' => $module->config['fa_name'],
                'permission' => $module->config['en_plural_name'].'.index',

                'icon' => $module->config['icon'],
                'route' => strtolower($module->config['en_name']),
            ]);


            PackageName::updateOrCreate(['title' => $module->config['en_name']], ['display_name' => $module->config['fa_name']]);
            foreach ($module->config['menus'] as $key => $menu) {
                Menu::updateOrCreate([
                    'route' => $key
                ], [
                    'label' => $menu['label'],
                    'permission' => $menu['permission'],
                    'icon' => $menu['icon'],
                    'parent_id' => $parent_menu->id
                ]);
            }
        }


        $role = Role::updateOrCreate([
            'name' => 'super_admin',
        ], [
            'guard_name' => 'web',
            'display_name' => 'Super Admin'
        ]);


        foreach ($module->config['permissions'] as $key => $permission) {
            foreach ($permission['perms'] as $value) {
                switch ($value) {

                    case 'create';
                        $value1 = 'ثبت';
                        break;
                    case 'edit';
                        $value1 = 'ویرایش';

                        break;
                    case 'destroy';
                        $value1 = 'حذف';

                        break;
                    case 'index';
                        $value1 = 'مشاهده';

                        break;
                }

                $label = $value1 . ' ' . $permission['label'];

                $created_permission = Permission::updateOrCreate(


                    ['name' => $key . '.' . $value],

                    [
                        'name' => $key . '.' . $value,
                        'display_name' => $label
                    ]);


                if (!is_null($role))
                    $created_permission->assignRole($role);
            }
        }

        $module->customSetup();

        $this->info("Module $module_name initialized successfully!");
    }

    public function remove($module_name, $module)
    {
//        if ($this->confirm('Are you sure?')) {
        Artisan::call('module:migrate-rollback', ['module' => $module_name]);

        Menu::where('route', 'like', $module->config['en_plural_name'] . '%')->delete();
        PackageName::where('title', 'like', $module->config['en_plural_name'] . '%')->delete();
        Permission::where('name', 'like', $module->config['en_plural_name'] . '%')->delete();

        $module->customRemove();
        $this->info("Module $module_name removed!");
//        }
    }
}
