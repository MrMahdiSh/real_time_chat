<?php

namespace Modules\Setting\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Link\Entities\Link;
use Modules\Setting\Entities\ContactUs;
use Modules\Setting\Entities\Setting;

class SettingController extends Controller
{

    public function index()
    {
        auth()->user()->can('Setting.index') ? '' : abort(403);
        $data = Setting::with('logo')->first();


        return view('setting::setting', compact('data'));
    }





    public function update(Request $request, $id)
    {

        auth()->user()->can('Setting.index') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Setting::find($id);

        if (!isset($insert)) {
            $insert = Setting::create($data);


            if ($request->image) {
                Core::SaveImage($request->image, 'LOGO', $insert->id);
            }
            return Core::true();
        }


        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'LOGO', $insert->id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Setting.destroy') ? '' : abort(403);

        if (ContactUs::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
