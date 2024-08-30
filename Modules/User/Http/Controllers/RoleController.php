<?php

namespace Modules\User\Http\Controllers;

use App\Helper\Core;
use App\PackageName;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        auth()->user()->can('Roles.index') ? ' ' : abort(403);
        $roles = Role::where('name', '<>', 'user')->where('name', '<>', 'super_admin')->get();

        return view('user::role.index', compact('roles'));
    }


    public function create()
    {

        auth()->user()->can('Roles.create') ? ' ' : abort(403);


        $packages = PackageName::get();


        return view('user::role.create', compact('packages'));
    }


    public function store(Request $request)
    {
        auth()->user()->can('Roles.create') ? ' ' : abort(403);

        $data = $request->except('_token', '_method', 'proengsoft_jsvalidation');

        $role = Role::create([
            'name' => $data['name'],
            'display_name' => $data['display_name']
        ]);


        if ($role) {

            foreach ($data['roles'] as $item) {
                $perm = Permission::findById($item);
                $perm->assignRole($role);
            }

            return Core::true();
        } else {
            return Core::false();
        }

    }


    public function edit($id)
    {
        auth()->user()->can('Roles.edit') ? ' ' : abort(403);


        $data = Role::findById($id);
        $packages = PackageName::get();


//        with('permissions')->
//        return $data->permissions->where('id',20)->first();
        return view('user::role.edit', compact('data', 'packages'));
    }

    public function update(Request $request, $id)
    {
        auth()->user()->can('Roles.edit') ? ' ' : abort(403);
        $data = $request->except('_token', '_method', 'proengsoft_jsvalidation');
        $role = Role::findById($id);
        $role->update([
            'name' => $data['name'],
            'display_name' => $data['display_name']
        ]);


        $perms = [];
        foreach ($data['roles'] as $item) {

            $perm = Permission::findById($item);

            array_push($perms, $perm);
        }

        $role->syncPermissions($perms);


        return Core::true();
    }

    public function destroy($id)
    {
        auth()->user()->can('Roles.destroy') ? ' ' : abort(403);


        if (Role::find($id)->delete())
            return 'true';
        else
            return 'false';

    }
}
