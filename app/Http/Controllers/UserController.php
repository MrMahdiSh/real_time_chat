<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function setLocale($lang)
    {
        App::setLocale($lang);
        session()->put('locale', $lang);
        return App::getLocale();

    }

    public function index()
    {
        return view('auth.profile_edit');
    }
}
