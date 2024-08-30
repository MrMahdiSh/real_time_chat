<?php

namespace Modules\Special\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Special\Entities\Special;

class SpecialController extends Controller
{

    public function index()
    {
        auth()->user()->can('Special.index') ? '' : abort(403);
        $data = Special::with('media')->get();
        return view('special::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Special.create') ? '' : abort(403);

        return view('special::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Special.create') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Special::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Special', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Special.edit') ? '' : abort(403);
        $data = Special::with('media')->find($id);

        return view('special::edit', compact('data'));
    }




    public function update(Request $request, $id)
    {
        auth()->user()->can('Special.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Special::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Special', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Special.destroy') ? '' : abort(403);

        if (Special::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
