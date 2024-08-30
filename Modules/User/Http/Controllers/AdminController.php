<?php

namespace Modules\User\Http\Controllers;

use App\Helper\Core;
use App\Medium;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Modules\Doctor\Entities\Doctor;

class AdminController extends Controller
{

    public function doSignIn(Request $request, $id)
    {

        if (auth()->user()->can('Admins.index')) {
            try {
                $curUser  = auth()->user();
                $user = Doctor::find($id);
                // dd($user);
                // dd($user , $id );
                $request->session()->flush();
                Auth::guard('doctor')->login($user);
                $request->session()->put('backToAdminSession', $curUser->id);
                $request->session()->put('redirect_admin_url', url()->previous());
                $request->session()->put('previous_route_name', \Route::getRoutes()->match(
                    Request::create(\URL::previous())
                )->getName());
            } catch (\Throwable $th) {
                dd($th);
            }
            return redirect()->route('doctor.dashboard');
        }

        abort(403);
    }

    public function backToAdminSession()
    {
        if (!session('backToAdminSession')) {
            abort(404);
        }
        $redirectUrl = route('dashboard');
        if (session('previous_route_name') != 'admin.doSignIn') {
            $redirectUrl = session('redirect_admin_url');
        }
        Auth::login(User::find(session('backToAdminSession')));
        request()->session()->forget('backToAdminSession');
        request()->session()->forget('redirect_admin_url');
        return redirect()->to($redirectUrl);
    }

    public function index()
    {
        auth()->user()->can('Admins.index') ? '' : abort(403);

        $data = User::where('id', '<>', auth()->id())->get();
        $users = array();

        foreach ($data as $item) {


            array_push($users, $item);
        }
        return view('user::index', compact('users'));
    }


    public function create()
    {

        auth()->user()->can('Admins.create') ? '' : abort(403);

        $roles = Role::where('name', '<>', 'super_admin')->get();
        return view('user::create', compact('roles'));
    }


    public function store(Request $request)
    {
        auth()->user()->can('Admins.create') ? '' : abort(403);

        $data = $request->except('role', 'proengsoft_jsvalidation', 'password_confirmation', '_token', '_method');

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($user) {


            if ($request->image) {
                Core::SaveImage($request->image, 'avatar_admin', $user->id);
            }


            if ((int)$request->role != 0) {

                $role = Role::findById($request->role);
                $user->syncRoles([$role->name]);
            }

            return Core::true();
        } else {


            return Core::false();
        }
    }


    public function edit($id)
    {
        auth()->user()->can('Admins.edit') ? '' : abort(403);

        $data = User::with('roles', 'gallery', 'media')->find($id);


        $roles = Role::where('name', '<>', 'super_admin')->get();

        return view('user::edit', compact('data', 'roles'));
    }


    public function update(Request $request, $id)
    {

        auth()->user()->can('Admins.edit') ? '' : abort(403);

        $data = $request->except('password', 'role', 'proengsoft_jsvalidation', 'password_confirmation', '_token', '_method');
        $user = User::find($id);


        if (isset($request->password)) {

            $user['password'] = Hash::make($request->password);
        }
        if ((int)$request->role != 0) {

            $role = Role::findById($request->role);
            $user->syncRoles([$role->name]);
        }
        if ($user->update($data)) {



            if ($request->image) {
                Core::SaveImage($request->image, 'avatar_admin', $id);
            }
            if (isset($request->gallery)) {
                try {

                    foreach ($request->gallery as $key => $item) {
                        Core::SaveFiles($item, 'gallery', $id);
                    }
                } catch (\Exception $e) {
                }
            }


            if ((int)$request->role != 0) {

                $role = Role::findById($request->role);
                $user->syncRoles([$role->name]);
            }

            return Core::true();
        } else {


            return Core::false();
        }
    }

    public function destroy($id)
    {
        auth()->user()->can('Admins.destroy') ? '' : abort(403);


        if (User::find($id)->delete()) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
