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

class ContactUsController extends Controller
{

    public function index()
    {
        auth()->user()->can('Setting.index') ? '' : abort(403);
        $data = ContactUs::get();

        foreach ($data as $item) {
            $item->date = Core::ArticleDate($item->created_at, false);
        }
        return view('setting::contact_us.index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Setting.index') ? '' : abort(403);

        $data = Setting::first();


        return view('setting::contact_us.setting', compact('data'));
    }

    public function status($id)
    {
        auth()->user()->can('Setting.index') ? '' : abort(403);
        $data = ContactUs::find($id);
        $status = (int)$data->seen;
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;

        }
        $data->update(['seen' => $status . '']);
        return Core::true();
    }


    public function update(Request $request, $id)
    {

        auth()->user()->can('Setting.index') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Setting::find($id);

        if (!isset($insert)) {
            $insert = Setting::create($data);
            return Core::true();
        }


        if ($insert->update($data)) {
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
