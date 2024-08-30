<?php

namespace Modules\Link\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Link\Entities\Link;

class LinkController extends Controller
{

    public function index()
    {
        auth()->user()->can('Link.index') ? '' : abort(403);
        $data = Link::get();
        return view('link::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Link.create') ? '' : abort(403);
        return view('link::create');
    }


    public function store(Request $request)
    {
        auth()->user()->can('Link.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = Link::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Link', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }



    public function edit($id)
    {
        auth()->user()->can('Link.edit') ? '' : abort(403);
        $data = Link::find($id);

        return view('link::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Link.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = Link::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Link', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Link.destroy') ? '' : abort(403);

        if (Link::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
