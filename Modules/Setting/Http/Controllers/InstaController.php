<?php

namespace Modules\Setting\Http\Controllers;

use App\Helper\Core;
use App\Helper\InstagramApiPhp;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\In;
use Modules\Insta\Entities\Insta;
use Modules\Insta\Entities\InstaKey;

class InstaController extends Controller
{

    public function set_auth_token($auth_token = 'auth_token')
    {
        auth()->user()->can('Insta.index') ? '' : abort(403);

        if ($auth_token == 'auth_token') {
            return 'is_ready';
        }
        $setting = InstaKey::first();
        $insta_data = Insta::first();

        if (!isset($setting)) {
            return redirect()->route('InstaKey.index');
        }
        $instagram = new InstagramApiPhp([
            'appId' => $setting->app_id,
            'appSecret' => $setting->app_secret,
            'redirectUri' => $setting->redirect_url,
            'access_token' => isset($insta_data) ? $insta_data->access_token : '0',
        ]);
        $result = $instagram->getOAuthToken($auth_token);

        if (isset($result->code) && $result->code == 400) {
            $login_url = $instagram->getLoginUrl();
            return $login_url;
        } else {

            $insta_data->update(['user_id' => $result->user_id,
                'auth_token' => $auth_token,
                'access_token' => $result->access_token]);

            $result2 = $instagram->getLongLivedToken($result->access_token, true);


            $insta_data->update([
                'access_token' => $result2]);
            $instagram->setAccessToken($result->access_token);
            return redirect()->route('Insta.index');
        }

    }

    public function index()
    {
        auth()->user()->can('Insta.index') ? '' : abort(403);

        $setting = InstaKey::first();
        $insta_data = Insta::first();

        if (!isset($insta_data)) {
            $insta_data = Insta::create(['access_token' => '0']);
        }

        if (!isset($setting)) {
            return redirect()->route('InstaKey.index');
        }
        $instagram = new InstagramApiPhp([
            'appId' => $setting->app_id,
            'appSecret' => $setting->app_secret,
            'redirectUri' => $setting->redirect_url,
            'access_token' => isset($insta_data) ? $insta_data->access_token : '0',
        ]);
        $login_url = $instagram->getLoginUrl();
        $result = $instagram->getUserProfile();

        return view('setting::insta_setting', compact('login_url', 'result'));
    }


}
