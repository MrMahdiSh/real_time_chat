<?php

namespace Modules\Setting\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rules\In;
use Modules\Insta\Entities\Insta;
use Modules\Insta\Entities\InstaKey;

class InstaKeyController extends Controller
{

    public function index()
    {
        auth()->user()->can('Insta.index') ? '' : abort(403);


        $data = InstaKey::first();
        $data = isset($data) ? $data : InstaKey::create(['app_id' => '000']);

        return view('setting::insta_key', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Insta.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = InstaKey::find($id);
//        $insert->slug = null;
        if ($insert->update($data)) {

            return Core::true();
        } else
            return Core::false();


    }


}
