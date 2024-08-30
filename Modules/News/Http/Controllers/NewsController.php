<?php

namespace Modules\News\Http\Controllers;

use App\Helper\Core;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Entities\Article;
use Modules\News\Entities\News;

class NewsController extends Controller
{

    public function index()
    {
        auth()->user()->can('News.index') ? '' : abort(403);
        $data = News::get();
        return view('news::index', compact('data'));
    }


    public function create()
    {
        auth()->user()->can('News.create') ? '' : abort(403);
        return view('news::create');
    }

    public function status($id)
    {
        auth()->user()->can('News.edit') ? '' : abort(403);

        $data = News::find($id);
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
        auth()->user()->can('News.create') ? '' : abort(403);

        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');

        $insert = News::create($data);

        if ($insert) {

            if ($request->image) {
                Core::SaveImage($request->image, 'News', $insert->id);
            }


            return Core::true();
        } else
            return Core::false();
    }


    public function edit($id)
    {
        auth()->user()->can('News.edit') ? '' : abort(403);
        $data = News::find($id);

        return view('news::edit', compact('data'));
    }


    public function update(Request $request, $id)
    {
        auth()->user()->can('News.edit') ? '' : abort(403);
        $data = $request->except('_token', '_method', 'image', 'proengsoft_jsvalidation');
        $insert = News::find($id);
        if ($insert->update($data)) {
            if ($request->image) {
                Core::SaveImage($request->image, 'News', $id);
            }
            return Core::true();
        } else
            return Core::false();
    }


    public function destroy($id)
    {
        auth()->user()->can('News.destroy') ? '' : abort(403);

        if (News::find($id)->delete()) {
            return 'true';

        } else
            return 'false';


    }
}
