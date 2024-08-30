<?php

namespace App\Http\Controllers;

use App\Helper\Core;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {

        $data = User::with('media')->find(\auth()->id());

        return view('auth.profile_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {



        $data = $request->except('image', '_token', '_method', 'proengsoft_jsvalidation', 'password');

        if (isset($request->password))
            $data['password'] = Hash::make($request->password);


        $user = User::find($id);
        if ($user->update($data)) {

            if ($request->image) {

                Core::SaveImage($request->image, 'avatar_admin', $id);
            }


            return Core::true();
        } else {
            return Core::false();

        }


    }
}
