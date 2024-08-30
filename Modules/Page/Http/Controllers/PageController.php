<?php

namespace Modules\Page\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\Page\Entities\Page;

class PageController extends Controller
{

    public function index()
    {
        auth()->user()->can('Page.index') ? '' : abort(403);
        $data = Page::with('media')->get();
        return view('page::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('Page.create') ? '' : abort(403);
        return view('page::create');
    }

    public function status($id)
    {
        auth()->user()->can('Page.edit') ? '' : abort(403);

        $data = Page::find($id);
        $status = (int)$data->status;
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;

        }
        $data->update(['status' => $status . '']);
        return Core::true();
    }

    public function store(Request $request)
    {
        auth()->user()->can('Page.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $data['status'] = '1';
        $data['add_to_article'] = isset($data['add_to_article']) ? '1' : '0';
        $insert = Page::create($data);


        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'Pages', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('Page.edit') ? '' : abort(403);
        $data = Page::with('media')->find($id);

        return view('page::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('Page.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $data['add_to_article'] = isset($data['add_to_article']) ? '1' : '0';

        $insert = Page::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'Page', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('Page.destroy') ? '' : abort(403);

        if (Page::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
